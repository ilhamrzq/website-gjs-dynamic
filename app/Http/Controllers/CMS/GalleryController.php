<?php

namespace App\Http\Controllers\CMS;

use App\DataTables\CMS\GalleryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\GalleryCategoryRequest;
use App\Http\Requests\CMS\GalleryImageRequest;
use App\Models\CMS\GalleryCategory;
use App\Models\CMS\GalleryImage;
use App\Models\Master\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index(GalleryDataTable $dataTable)
    {
        return $dataTable->render('cms.gallery.index', [
            'table_title' => 'Gallery Table',
            'add_button' => 'Add New Gallery',
            'action' => route('cms.galleries.create')
        ]);
    }

    public function create()
    {
        session(['activeTab' => 'galleryData']);
        return view('cms.gallery.add-edit', [
            'action' => route('cms.galleries.store'),
            'action_back' => route('cms.galleries.index'),
            'title' => "Add New Gallery",
            'gallery_images' => [],
            'galleries' => GalleryImage::active(),
        ]);
    }

    public function store(GalleryCategoryRequest $request, GalleryCategory $galleryCategory)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $galleryCategory = new GalleryCategory();
            $galleryCategory->category_name_id = $validated['category_name_id'];
            $galleryCategory->category_name_en = $validated['category_name_en'];
            $galleryCategory->category_slug_id = Str::slug($validated['category_name_id']);
            $galleryCategory->category_slug_en = Str::slug($validated['category_name_en']);
            $galleryCategory->is_active = 1;
            $galleryCategory->created_by = $user->id;
            $galleryCategory->updated_by = $user->id;
            $galleryCategory->save();

            $encryptedId = Crypt::encrypt($galleryCategory->id);
            return Redirect::route('cms.galleries.edit', $encryptedId)
                            ->with('success', 'The new gallery was added successfully')
                            ->with('activeTab', 'galleryImage');
        } catch (\Throwable $e) {
            if (str_contains($e->getMessage(), 'duplicate key value violates unique constraint')) {
                return Redirect::back()
                    ->withInput()
                    ->with('error', 'Category with similar name already exists. Please use a different name.');
            }

            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $gallery = getDecryptedModelId($encryptedId, GalleryCategory::class);
        $galleryName = GalleryCategory::where('id', $gallery->id)->pluck('category_name_id')->first();
        $galleryImages = GalleryImage::imagesByCategory($gallery->id);

        return view('cms.gallery.add-edit', [
            'action' => $action,
            'action_back' => route('cms.galleries.index'),
            'record' => $gallery,
            'title' => $title . ' ' . $galleryName,
            'gallery_images' => $galleryImages ?? '',
            'galleries' => GalleryImage::active(),
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail Gallery');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('cms.galleries.update', $encryptedId), 'Edit Gallery');
    }

    public function update(GalleryCategoryRequest $request, $encryptedId)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, GalleryCategory::class);
            $galleryCategory = GalleryCategory::find($data->id);

            $galleryCategory->category_name_id = $validated['category_name_id'];
            $galleryCategory->category_name_en = $validated['category_name_en'];
            $galleryCategory->category_slug_id = Str::slug($validated['category_name_id']);
            $galleryCategory->category_slug_en = Str::slug($validated['category_name_en']);
            $galleryCategory->updated_by = $user->id;
            $galleryCategory->is_active = 1;
            $galleryCategory->save();

            return responseSuccess('update', route('cms.galleries.index'));

        } catch (\Throwable $e) {
            if (str_contains($e->getMessage(), 'duplicate key value violates unique constraint')) {
                return Redirect::back()
                    ->withInput()
                    ->with('error', 'Category with similar name already exists. Please use a different name.');
            }
            
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, GalleryCategory::class);
            $galleryCategory = GalleryCategory::find($data->id);

            $galleryCategory->deleted_by = $user->id;
            $galleryCategory->is_active = 0;
            $galleryCategory->save();
            $galleryCategory->delete();
            return responseSuccess('delete', route('cms.galleries.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Auth::user()->can('delete cms/galleries')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete gallery data"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $id) {
                $galleryCategory = GalleryCategory::find($id);
                $galleryCategory->deleted_by = Auth::user()->id;
                $galleryCategory->is_active = 0;
                $galleryCategory->save();
                $galleryCategory->delete();
            }

            DB::commit();
            return responseJsonSuccess("Gallery data has been successfully deleted");
        } catch (\Throwable $e) {
            DB::rollBack();
            return responseJsonError($e);
        }
    }

    
    public function uploadImages(GalleryImageRequest $request)
    {
        $validated = $request->validated();
        $files = $validated['file'];
        $user = Auth::user();
        $encryptedId = $request->input('encrypted');
        $data = getDecryptedModelId($encryptedId, GalleryCategory::class);
        $galleryCategory = GalleryCategory::find($data->id);

        $basePath = public_path("assets/pbc/images/galleryCategories/");
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
            $newImage = GalleryImage::create([
                'category_id' => $galleryCategory->id,
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
            $filePath = "assets/pbc/images/galleryCategories/" . $fileName;
            $fileSize = filesize($basePath . "/" . $fileName);

            $newImage->update([
                'file_path' => $filePath,
                'file_name' => $fileName,
                'file_size' => $fileSize,
            ]);
        }

        session(['activeTab' => 'galleryImage']);
        return redirect()->back();
    }

    public function updateDefaultImage(Request $request, $imageId)
    {
        try {
            $encryptedId = $request->input('encrypted');
            $data = getDecryptedModelId($encryptedId, GalleryCategory::class);
            $imageDefault = GalleryImage::where('category_id', $data->id)->where('is_default', true)->first();

            if ($imageDefault) {
                $imageDefault->is_default = false;
                $imageDefault->updated_by = Auth::user()->id;
                $imageDefault->save();
            }

            $image = GalleryImage::find($imageId);
            if ($image) {
                $image->is_default = $request->is_default;
                $image->updated_by = Auth::user()->id;
                $image->save();
            }

            session(['activeTab' => 'galleryImage']);
            return response()->json([
                'success' => true,
                'status_code' => 200,
                'message' => 'Image default status updated successfully'
            ], 200);
        } catch (\Throwable $e) {
            session(['activeTab' => 'galleryImage']);
            return response()->json([
                'success' => false,
                'status_code' => 500,
                'message' => 'Failed to updated status'
            ], 500);
        }
    }

    public function deleteGalleryImage(Request $request, $imageId)
    {
        try {
            $imageId = $request->segment(3);
            $user = Auth::user();
            $image = GalleryImage::find($imageId);
            $image->deleted_by = $user->id;
            $image->is_active = 0;
            $image->save();
            $image->delete();

            session(['activeTab' => 'galleryImage']);
            return redirect()->back()->with('success', 'Gallery image has been deleted successfully');
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }
}
