<?php

namespace App\Http\Controllers\CMS;

use App\DataTables\CMS\HomepageDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\HomepageHeroImageRequest;
use App\Http\Requests\CMS\HomepageRequest;
use App\Http\Requests\CMS\HomepageRequestEdit;
use App\Models\CMS\Homepage;
use App\Models\CMS\HomepageHeroImage;
use App\Models\Master\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class HomepageController extends Controller
{
    public function index(HomepageDataTable $dataTable)
    {
        return $dataTable->render('cms.homepage.index', [
            'table_title' => 'Homepage Table',
            'add_button' => 'Add New Homepage',
            'action' => route('cms.homepage.create')
        ]);
    }

    public function create()
    {
        session(['activeTab' => 'homepageData']);
        return view('cms.homepage.add-edit', [
            'action' => route('cms.homepage.store'),
            'action_back' => route('cms.homepage.index'),
            'title' => 'Add New Homepage',
            'hero_images' => [],
            'languages' => Language::active(),
        ]);
    }

    public function store(HomepageRequest $request, Homepage $homepage)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $videoFile = $request->file('video');

            $basePath = public_path("assets/pbc/videos/homepage/" );
            if (!File::exists($basePath)) {
                File::makeDirectory($basePath, 0755, true, true);
            }

            // Nama file berdasarkan datetime
            $fileName = now()->format('Ymd_His') . '.' . $videoFile->getClientOriginalExtension();
            $videoFile->move($basePath, $fileName);

            $filePath = "assets/pbc/videos/homepage/" . $fileName;
            $fileSize = filesize($basePath . "/" . $fileName);
            
            $homepage = new Homepage();
            $homepage->lang_id = $validated['lang_id'];
            $homepage->hero_title = $validated['hero_title'];
            $homepage->hero_description = $validated['hero_description'];
            $homepage->feature_left_title = $validated['feature_left_title'];
            $homepage->feature_left_description = $validated['feature_left_description'];
            $homepage->feature_center_title = $validated['feature_center_title'];
            $homepage->feature_center_description = $validated['feature_center_description'];
            $homepage->feature_right_title = $validated['feature_right_title'];
            $homepage->feature_right_description = $validated['feature_right_description'];
            $homepage->video_path = $filePath;
            $homepage->video_name = $fileName;
            $homepage->video_size = $fileSize;
            $homepage->created_by = $user->id;
            $homepage->updated_by = $user->id;
            $homepage->is_active = 1;
            $homepage->save();

            $encryptedId = Crypt::encrypt($homepage->id);
            return Redirect::route('cms.homepage.edit', $encryptedId)
                            ->with('success', 'The new homepage was added successfully')
                            ->with('activeTab', 'homepageImage');

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $homepage = getDecryptedModelId($encryptedId, Homepage::class);
        $homepageName = Homepage::where('id', $homepage->id)->pluck('hero_title')->first();
        $homepageImages = HomepageHeroImage::imagesByHomepage($homepage->id);

        return view('cms.homepage.add-edit', [
            'action' => $action,
            'action_back' => route('cms.homepage.index'),
            'record' => $homepage,
            'title' => $title . ' ' . $homepageName,
            'hero_images' => $homepageImages ?? '',
            'homepage_name' => $homepageName,
            "languages" => Language::active(),
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail Type');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('cms.homepage.update', $encryptedId), 'Edit Type');
    }

    public function update(HomepageRequestEdit $request, $encryptedId)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $data = getDecryptedModelId($encryptedId, Homepage::class);
            $homepage = Homepage::find($data->id);

            if ($request->hasFile('video')) {
                $videoFile = $request->file('video');
    
                $basePath = public_path("assets/pbc/videos/homepage/" );
                if (!File::exists($basePath)) {
                    File::makeDirectory($basePath, 0755, true, true);
                }
    
                // Nama file berdasarkan datetime
                $fileName = now()->format('Ymd_His') . '.' . $videoFile->getClientOriginalExtension();
                $videoFile->move($basePath, $fileName);
                $fileSize = filesize($basePath . "/" . $fileName);
    
                $homepage->video_path = "assets/pbc/videos/homepage/" . $fileName;
                $homepage->video_name = $fileName;
                $homepage->video_size = $fileSize;
            }

            $homepage->lang_id = $validated['lang_id'];
            $homepage->hero_title = $validated['hero_title'];
            $homepage->hero_description = $validated['hero_description'];
            $homepage->feature_left_title = $validated['feature_left_title'];
            $homepage->feature_left_description = $validated['feature_left_description'];
            $homepage->feature_center_title = $validated['feature_center_title'];
            $homepage->feature_center_description = $validated['feature_center_description'];
            $homepage->feature_right_title = $validated['feature_right_title'];
            $homepage->feature_right_description = $validated['feature_right_description'];
            $homepage->updated_by = $user->id;
            $homepage->is_active = 1;
            $homepage->save();

            return responseSuccess('update', route('cms.homepage.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, Homepage::class);
            $homepage = Homepage::find($data->id);

            $homepage->deleted_by = $user->id;
            $homepage->is_active = 0;
            $homepage->save();
            $homepage->delete();
            return responseSuccess('delete', route('cms.homepage.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Auth::user()->can('delete cms/homepage')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete Homepage"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $id) {
                $homepage = Homepage::find($id);
                $homepage->deleted_by = Auth::user()->id;
                $homepage->is_active = 0;
                $homepage->save();
                $homepage->delete();
            }

            DB::commit();
            return responseJsonSuccess("Homepage data has been successfully deleted");
        } catch (\Throwable $e) {
            DB::rollBack();
            return responseJsonError($e);
        }
    }

    public function uploadImages(HomepageHeroImageRequest $request)
    {
        $validated = $request->validated();
        $files = $validated['file'];
        $user = Auth::user();
        $encryptedId = $request->input('encrypted');
        $data = getDecryptedModelId($encryptedId, Homepage::class);
        $homepage = Homepage::find($data->id);
        $homepageName = $homepage->hero_title;

        $basePath = public_path("assets/pbc/images/homepage" . implode("_", explode(" ", strtolower($homepageName))));
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
            $newHomepageHeroImage = HomepageHeroImage::create([
                'cms_homepage_id' => $homepage->id,
                'file_path' => '',
                'file_name' => '',
                'file_size' => 0,
                'is_default' => 0,
                'is_active' => 1,
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ]);

            $idFormatted = str_pad($newHomepageHeroImage->id, 6, '0', STR_PAD_LEFT);
            $extension = $file->getClientOriginalExtension();
            $fileName = "{$idFormatted}.{$extension}";

            $file->move($basePath, $fileName);
            $filePath = "assets/pbc/images/homepage" . implode("_", explode(" ", strtolower($homepageName))) . "/" . $fileName;
            $fileSize = filesize($basePath . "/" . $fileName);

            $newHomepageHeroImage->update([
                'file_path' => $filePath,
                'file_name' => $fileName,
                'file_size' => $fileSize,
            ]);
        }

        session(['activeTab' => 'homepageImage']);
        return redirect()->back();
    }

    public function updateDefaultImage(Request $request, $imageId)
    {
        try {
            $encryptedId = $request->input('encrypted');
            $data = getDecryptedModelId($encryptedId, Homepage::class);
            $imageDefault = HomepageHeroImage::where('cms_homepage_id', $data->id)->where('is_default', true)->first();

            if ($imageDefault) {
                $imageDefault->is_default = false;
                $imageDefault->updated_by = Auth::user()->id;
                $imageDefault->save();
            }

            $image = HomepageHeroImage::find($imageId);
            if ($image) {
                $image->is_default = $request->is_default;
                $image->updated_by = Auth::user()->id;
                $image->save();
            }

            session(['activeTab' => 'homepageImage']);
            return response()->json([
                'success' => true,
                'status_code' => 200,
                'message' => 'Image thumbnail video default status updated successfully'
            ], 200);
        } catch (\Throwable $e) {
            session(['activeTab' => 'homepageImage']);
            return response()->json([
                'success' => false,
                'status_code' => 500,
                'message' => 'Failed to updated status'
            ], 500);
        }
    }

    public function deletehomepageHeroImage(Request $request, $imageId)
    {
        try {
            $imageId = $request->segment(3);
            $user = Auth::user();
            $image = HomepageHeroImage::find($imageId);
            $image->deleted_by = $user->id;
            $image->is_active = 0;
            $image->save();
            $image->delete();

            session(['activeTab' => 'homepageImage']);
            return redirect()->back()->with('success', 'Image thumbnail video has been deleted successfully');
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }
}
