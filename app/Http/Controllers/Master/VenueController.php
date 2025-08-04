<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\VenueDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\VenueRequest;
use App\Http\Requests\Venue\VenueImageRequest;
use App\Models\Master\Venue;
use App\Models\Venue\VenueImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class VenueController extends Controller
{
    public function index(VenueDataTable $dataTable)
    {
        return $dataTable->render('venues.places.index', [
            'table_title' => 'Venue Table',
            'add_button' => 'Add New Venue',
            'action' => route('venues.places.create')
        ]);
    }

    public function create()
    {
        session(['activeTab' => 'venueData']);

        return view('venues.places.add-edit', [
            'action' => route('venues.places.store'),
            'action_back' => route('venues.places.index'),
            'title' => "Add New Venue",
            'venue_images' => [],
        ]);
    }

    public function store(VenueRequest $request, Venue $venue)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();
            // dd($request->validated());

            $venue = new Venue();
            $venue->venue_name = $validated['venue_name'];
            $venue->venue_address = $validated['venue_address'];
            $venue->venue_price = $validated['venue_price'];
            $venue->venue_url = $validated['venue_url'];
            $venue->venue_slug = Str::slug($validated['venue_name']);
            $venue->venue_opening_time = $validated['venue_opening_time'];
            $venue->venue_closing_time = $validated['venue_closing_time'];
            $venue->created_by = $user->id;
            $venue->updated_by = $user->id;
            $venue->is_active = 1;
            $venue->save();

            $encryptedId = Crypt::encrypt($venue->id);
            return Redirect::route('venues.places.edit', $encryptedId)
                            ->with('success', 'The new venue was added successfully')
                            ->with('activeTab', 'venueImages');

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $venue = getDecryptedModelId($encryptedId, Venue::class);
        $venueImages = VenueImage::imagesByVenue($venue->id);
        $venueName = Venue::where('id', $venue->id)->pluck('venue_name')->first();

        return view('venues.places.add-edit', [
            'action' => $action,
            'action_back' => route('venues.places.index'),
            'record' => $venue,
            'title' => $title . ' ' . $venue->venue_name,
            'venue_images' => $venueImages ?? '',
            'venue_name' => $venueName,
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail Venue');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('venues.places.update', $encryptedId), 'Edit Venue');
    }

    public function update(VenueRequest $request, $encryptedId)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, Venue::class);
            
            $venue = Venue::find($data->id);
            $venue->venue_name = $validated['venue_name'];
            $venue->venue_address = $validated['venue_address'];
            $venue->venue_price = $validated['venue_price'];
            $venue->venue_url = $validated['venue_url'];
            $venue->venue_slug = Str::slug($validated['venue_name']);
            $venue->venue_opening_time = $validated['venue_opening_time'];
            $venue->venue_closing_time = $validated['venue_closing_time'];
            $venue->updated_by = $user->id;
            $venue->is_active = 1;
            $venue->save();

            return responseSuccess('update', route('venues.places.index'));

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, Venue::class);
            $menu = Venue::find($data->id);

            $menu->deleted_by = $user->id;
            $menu->is_active = 0;
            $menu->save();
            $menu->delete();
            return responseSuccess('delete', route('venues.places.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Auth::user()->can('delete venues/places')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete venue"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $id) {
                $venue = Venue::find($id);
                $venue->deleted_by = Auth::user()->id;
                $venue->is_active = 0;
                $venue->save();
                $venue->delete();

                $images = VenueImage::where('venue_id', $id)->get();
                foreach ($images as $image) {
                    $venueImage = VenueImage::find($image->id);
                    $venueImage->deleted_by = $user->id;
                    $venueImage->is_active = 0;
                    $venueImage->save();
                    $venueImage->delete();
                }
            }

            DB::commit();
            return responseJsonSuccess("Venue data has been successfully deleted");
        } catch (\Throwable $e) {
            DB::rollBack();
            return responseJsonError($e);
        }
    }

    public function uploadImages(VenueImageRequest $request)
    {
        $validated = $request->validated();
        $files = $validated['file'];
        $user = Auth::user();
        $encryptedId = $request->input('encrypted');
        $data = getDecryptedModelId($encryptedId, Venue::class);
        $venue = Venue::find($data->id);
        $venueName = $venue->venue_name;

        $basePath = public_path("assets/pbc/images/venues/" . implode("_", explode(" ", strtolower($venueName))));
        if (!File::exists($basePath)) {
            File::makeDirectory($basePath, 0755, true, true);
            // 0755 permission file buat linux 
            // awalan, mendanakan oktal
            // 7 (Read, Write, Execute - Owner; 
            // 5 Read, Execute - Group; 
            // 5 Read, Execute - Others)

            // true, artinya bisa membuat folder secara recursive (kalo subfolder di dalam basePath belom ada, nanti bakalan dibuat sama laravel)
            // agar Laravel tidak error jika folder sudah ada.
        }

        foreach ($files as $file) {
            $newVenueImage = VenueImage::create([
                'venue_id' => $venue->id,
                'file_path' => '',
                'file_name' => '',
                'file_size' => 0,
                'is_default' => 0,
                'is_active' => 1,
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ]);

            $idFormatted = str_pad($newVenueImage->id, 6, '0', STR_PAD_LEFT);
            $extension = $file->getClientOriginalExtension();
            $fileName = "{$idFormatted}.{$extension}";

            $file->move($basePath, $fileName);
            $filePath = "assets/pbc/images/venues/" . implode("_", explode(" ", strtolower($venueName))) . "/" . $fileName;
            $fileSize = filesize($basePath . "/" . $fileName);

            $newVenueImage->update([
                'file_path' => $filePath,
                'file_name' => $fileName,
                'file_size' => $fileSize,
            ]);
        }

        session(['activeTab' => 'venueImages']);
        return redirect()->back();
    }


    public function updateDefaultImage(Request $request, $imageId)
    {
        try {
            $encryptedId = $request->input('encrypted');
            $data = getDecryptedModelId($encryptedId, Venue::class);
            $imageDefault = VenueImage::where('venue_id', $data->id)->where('is_default', true)->first();

            if ($imageDefault) {
                $imageDefault->is_default = false;
                $imageDefault->updated_by = Auth::user()->id;
                $imageDefault->save();
            }

            $image = VenueImage::find($imageId);
            if ($image) {
                $image->is_default = $request->is_default;
                $image->updated_by = Auth::user()->id;
                $image->save();
            }

            session(['activeTab' => 'venueImages']);
            return response()->json([
                'success' => true,
                'status_code' => 200,
                'message' => 'Image default status updated successfully'
            ], 200);
        } catch (\Throwable $e) {
            session(['activeTab' => 'venueImages']);
            return response()->json([
                'success' => false,
                'status_code' => 500,
                'message' => 'Failed to updated status'
            ], 500);
        }
    }

    public function deleteVenueImage(Request $request, $imageId)
    {
        try {
            $imageId = $request->segment(3);
            $user = Auth::user();
            $image = VenueImage::find($imageId);
            $image->deleted_by = $user->id;
            $image->is_active = 0;
            $image->save();
            $image->delete();

            session(['activeTab' => 'venueImages']);
            return redirect()->back()->with('success', 'Venue image has been deleted successfully');

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }
}
