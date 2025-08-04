<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\VenueRoomDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\VenueRoomRequest;
use App\Http\Requests\Venue\VenueRoomImageRequest;
use App\Models\Master\Language;
use App\Models\Master\Venue;
use App\Models\Master\VenueRoom;
use App\Models\Venue\VenueRoomImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class VenueRoomController extends Controller
{
    public function index(VenueRoomDataTable $dataTable)
    {
        return $dataTable->render('venues.rooms.index', [
            'table_title' => 'Venue Room Table',
            'add_button' => 'Add New Venue Room',
            'action' => route('venues.rooms.create')
        ]);
    }

    public function create()
    {
        session(['activeTab' => 'roomData']);

        return view('venues.rooms.add-edit', [
            'action' => route('venues.rooms.store'),
            'action_back' => route('venues.rooms.index'),
            'title' => "Add New Venue Room",
            'room_images' => [],
            'venues' => Venue::active(),
            'languages' => Language::active(),
        ]);
    }

    public function store(VenueRoomRequest $request, VenueRoom $room)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $room = new VenueRoom();
            $room->lang_id = $validated['lang_id'];
            $room->venue_id = $validated['venue_id'];
            $room->room_name = $validated['room_name'];
            $room->room_description = $validated['room_description'];
            $room->room_minimum_charge = $validated['room_minimum_charge'];
            $room->created_by = $user->id;
            $room->updated_by = $user->id;
            $room->is_active = 1;
            $room->save();

            $encryptedId = Crypt::encrypt($room->id);
            return Redirect::route('venues.rooms.edit', $encryptedId)
                            ->with('success', 'The new venue room was added successfully')
                            ->with('activeTab', 'roomImages');

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $room = getDecryptedModelId($encryptedId, VenueRoom::class);
        $roomImages = VenueRoomImage::imagesByVenueRoom($room->id);
        $roomName = VenueRoom::where('id', $room->id)->pluck('room_name')->first();

        return view('venues.rooms.add-edit', [
            'action' => $action,
            'action_back' => route('venues.rooms.index'),
            'record' => $room,
            'title' => $title . ' ' . $room->room_name,
            'room_images' => $roomImages ?? '',
            'room_name' => $roomName,
            'venues' => Venue::active(),
            'languages' => Language::active()
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail Venue Room');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('venues.rooms.update', $encryptedId), 'Edit Venue Room');
    }

    public function update(VenueRoomRequest $request, $encryptedId)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, VenueRoom::class);
            
            $room = VenueRoom::find($data->id);
            $room->lang_id = $validated['lang_id'];
            $room->venue_id = $validated['venue_id'];
            $room->room_name = $validated['room_name'];
            $room->room_description = $validated['room_description'];
            $room->room_minimum_charge = $validated['room_minimum_charge'];
            $room->updated_by = $user->id;
            $room->is_active = 1;
            $room->save();

            return responseSuccess('update', route('venues.rooms.index'));

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, VenueRoom::class);
            $menu = VenueRoom::find($data->id);

            $menu->deleted_by = $user->id;
            $menu->is_active = 0;
            $menu->save();
            $menu->delete();
            return responseSuccess('delete', route('venues.rooms.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Auth::user()->can('delete venues/rooms')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete venue room"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $id) {
                $room = VenueRoom::find($id);
                $room->deleted_by = Auth::user()->id;
                $room->is_active = 0;
                $room->save();
                $room->delete();

                $images = VenueRoomImage::where('room_id', $id)->get();
                foreach ($images as $image) {
                    $roomImage = VenueRoomImage::find($image->id);
                    $roomImage->deleted_by = $user->id;
                    $roomImage->is_active = 0;
                    $roomImage->save();
                    $roomImage->delete();
                }
            }

            DB::commit();
            return responseJsonSuccess("Venue room data has been successfully deleted");
        } catch (\Throwable $e) {
            DB::rollBack();
            return responseJsonError($e);
        }
    }

    public function uploadImages(VenueRoomImageRequest $request)
    {
        $validated = $request->validated();
        $files = $validated['file'];
        $user = Auth::user();
        $encryptedId = $request->input('encrypted');
        $data = getDecryptedModelId($encryptedId, VenueRoom::class);
        $room = VenueRoom::find($data->id);
        $roomName = $room->room_name;

        $basePath = public_path("assets/pbc/images/rooms/" . implode("_", explode(" ", strtolower($roomName))));
        
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
            $newImage = VenueRoomImage::create([
                'room_id' => $room->id,
                'file_path' => '',
                'file_name' => '',
                'file_size' => 0, 
                'is_default' => 0,
                'is_active' => 1,
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ]);

            $idFormatted = str_pad($newImage->id, 6, '0', STR_PAD_LEFT);
            $extension = $file->getClientOriginalExtension();
            $fileName = "{$idFormatted}.{$extension}";

            $file->move($basePath, $fileName);
            $filePath = "assets/pbc/images/rooms/" . implode("_", explode(" ", strtolower($roomName))) . "/" . $fileName;
            $fileSize = filesize($basePath . "/" . $fileName);

            // Update record dengan info file lengkap
            $newImage->update([
                'file_path' => $filePath,
                'file_name' => $fileName,
                'file_size' => $fileSize,
            ]);
        }

        session(['activeTab' => 'roomImages']);
        return redirect()->back();
    }

    public function updateDefaultImage(Request $request, $imageId)
    {
        try {
            $encryptedId = $request->input('encrypted');
            $data = getDecryptedModelId($encryptedId, VenueRoom::class);
            $imageDefault = VenueRoomImage::where('room_id', $data->id)->where('is_default', true)->first();

            if ($imageDefault) {
                $imageDefault->is_default = false;
                $imageDefault->updated_by = Auth::user()->id;
                $imageDefault->save();
            }

            $image = VenueRoomImage::find($imageId);
            if ($image) {
                $image->is_default = $request->is_default;
                $image->updated_by = Auth::user()->id;
                $image->save();
            }

            session(['activeTab' => 'roomImages']);
            return response()->json([
                'success' => true,
                'status_code' => 200,
                'message' => 'Image cover updated successfully'
            ], 200);
        } catch (\Throwable $e) {
            session(['activeTab' => 'roomImages']);
            return response()->json([
                'success' => false,
                'status_code' => 500,
                'message' => 'Failed to updated status'
            ], 500);
        }
    }

    public function deleteVenueRoomImage(Request $request, $imageId)
    {
        try {
            $imageId = $request->segment(3);
            $user = Auth::user();
            $image = VenueRoomImage::find($imageId);
            $image->deleted_by = $user->id;
            $image->is_active = 0;
            $image->save();
            $image->delete();

            session(['activeTab' => 'roomImages']);
            return redirect()->back()->with('success', 'Venue room image has been deleted successfully');

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }
}
