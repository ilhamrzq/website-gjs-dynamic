<?php

namespace App\Http\Controllers\CMS;

use App\DataTables\CMS\SponsorshipDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\SponsorshipImageRequest;
use App\Http\Requests\CMS\SponsorshipRequest;
use App\Models\CMS\Sponsorship;
use App\Models\CMS\SponsorshipImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class SponsorshipController extends Controller
{
    public function index(SponsorshipDataTable $dataTable)
    {
        return $dataTable->render('cms.sponsorship.index', [
            'table_title' => 'Sponsorship Type Table',
            'add_button' => 'Add New Sponsorship Type',
            'action' => route('cms.sponsorships.create')
        ]);
    }

    public function create()
    {
        session(['activeTab' => 'sponsorshipData']);
        return view('cms.sponsorship.add-edit', [
            'action' => route('cms.sponsorships.store'),
            'action_back' => route('cms.sponsorships.index'),
            'title' => 'Add New Sponsorship',
            'sponsorship_images' => [],
        ]);
    }

    public function store(SponsorshipRequest $request, Sponsorship $sponsorship)
    {
        try {

            $user = Auth::user();
            $validated = $request->validated();

            $sponsorship = new Sponsorship();
            $sponsorship->sponsor_type_name = $validated['sponsor_type_name'];
            $sponsorship->created_by = $user->id;
            $sponsorship->updated_by = $user->id;
            $sponsorship->is_active = 1;
            $sponsorship->save();

            $encryptedId = Crypt::encrypt($sponsorship->id);
            return Redirect::route('cms.sponsorships.edit', $encryptedId)
            ->with('success', 'The new sponsorship type was added successfully')
            ->with('activeTab', 'sponsorshipImage');
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $sponsorship = getDecryptedModelId($encryptedId, Sponsorship::class);
        $sponsorshipName = Sponsorship::where('id', $sponsorship->id)->pluck('sponsor_type_name')->first();
        $sponsorshipImages = SponsorshipImage::imagesBySponsorship($sponsorship->id);

        return view('cms.sponsorship.add-edit', [
            'action' => $action,
            'action_back' => route('cms.sponsorships.index'),
            'record' => $sponsorship,
            'title' => $title . ' ' . $sponsorshipName,
            'sponsorship_images' => $sponsorshipImages ?? '',
            'sponsorship_name' => $sponsorshipName,
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail Sponsorship Type');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('cms.sponsorships.update', $encryptedId), 'Edit Sponsorship Type');
    }

    public function update(SponsorshipRequest $request, $encryptedId)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();
            $sponsorship = getDecryptedModelId($encryptedId, Sponsorship::class);
            $sponsorship = Sponsorship::find($sponsorship->id);

            $sponsorship->sponsor_type_name = $validated['sponsor_type_name'];
            $sponsorship->updated_by = $user->id;
            $sponsorship->is_active = 1;
            $sponsorship->save();

            return responseSuccess('update', route('cms.sponsorships.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, Sponsorship::class);
            $sponsorship = Sponsorship::find($data->id);

            $sponsorship->deleted_by = $user->id;
            $sponsorship->is_active = 0;
            $sponsorship->save();
            $sponsorship->delete();
            return responseSuccess('delete', route('cms.sponsorships.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Auth::user()->can('delete cms/sponsorships')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete sponsorship type"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $id) {
                $sponsorship = Sponsorship::find($id);
                $sponsorship->deleted_by = Auth::user()->id;
                $sponsorship->is_active = 0;
                $sponsorship->save();
                $sponsorship->delete();
            }

            DB::commit();
            return responseJsonSuccess("Sponsorship data has been successfully deleted");
        } catch (\Throwable $e) {
            DB::rollBack();
            return responseJsonError($e);
        }
    }

    public function uploadImages(SponsorshipImageRequest $request)
    {
        $validated = $request->validated();
        $files = $validated['file'];
        $user = Auth::user();
        $encryptedId = $request->input('encrypted');
        $data = getDecryptedModelId($encryptedId, Sponsorship::class);
        $sponsorship = Sponsorship::find($data->id);
        $sponsorshipName = $sponsorship->sponsor_type_name;

        $basePath = public_path("assets/pbc/images/sponsorships/" . implode("_", explode(" ", strtolower($sponsorshipName))));
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
            $newSponsorshipImage = SponsorshipImage::create([
                'sponsor_id' => $sponsorship->id,
                'file_path' => '',
                'file_name' => '',
                'file_size' => 0,
                'is_default' => 0,
                'is_active' => 1,
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ]);

            $idFormatted = str_pad($newSponsorshipImage->id, 6, '0', STR_PAD_LEFT);
            $extension = $file->getClientOriginalExtension();
            $fileName = "{$idFormatted}.{$extension}";

            $file->move($basePath, $fileName);
            $filePath = "assets/pbc/images/sponsorships/" . implode("_", explode(" ", strtolower($sponsorshipName))) . "/" . $fileName;
            $fileSize = filesize($basePath . "/" . $fileName);

            $newSponsorshipImage->update([
                'file_path' => $filePath,
                'file_name' => $fileName,
                'file_size' => $fileSize,
            ]);
        }

        session(['activeTab' => 'sponsorshipImage']);
        return redirect()->back();
    }

    public function updateDefaultImage(Request $request, $imageId)
    {
        try {
            $encryptedId = $request->input('encrypted');
            $data = getDecryptedModelId($encryptedId, Sponsorship::class);
            $imageDefault = SponsorshipImage::where('sponsor_id', $data->id)->where('is_default', true)->first();

            if ($imageDefault) {
                $imageDefault->is_default = false;
                $imageDefault->updated_by = Auth::user()->id;
                $imageDefault->save();
            }

            $image = SponsorshipImage::find($imageId);
            if ($image) {
                $image->is_default = $request->is_default;
                $image->updated_by = Auth::user()->id;
                $image->save();
            }

            session(['activeTab' => 'sponsorshipImage']);
            return response()->json([
                'success' => true,
                'status_code' => 200,
                'message' => 'Image default status updated successfully'
            ], 200);
        } catch (\Throwable $e) {
            session(['activeTab' => 'sponsorshipImage']);
            return response()->json([
                'success' => false,
                'status_code' => 500,
                'message' => 'Failed to updated status'
            ], 500);
        }
    }

    public function deleteSponsorshipImage(Request $request, $imageId)
    {
        try {
            $imageId = $request->segment(3);
            $user = Auth::user();
            $image = SponsorshipImage::find($imageId);
            $image->deleted_by = $user->id;
            $image->is_active = 0;
            $image->save();
            $image->delete();

            session(['activeTab' => 'sponsorshipImage']);
            return redirect()->back()->with('success', 'Sponsorship image has been deleted successfully');
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }
}
