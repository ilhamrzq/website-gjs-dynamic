<?php

namespace App\Http\Controllers\CMS;

use App\DataTables\CMS\BookingPageDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\BookingPageRequest;
use App\Http\Requests\CMS\GalleryImageRequest;
use App\Models\CMS\BookingPage;
use App\Models\CMS\BookingPageImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class BookingPageController extends Controller
{
    public function index(BookingPageDataTable $dataTable)
    {
        return $dataTable->render('cms.booking-page.index', [
            'table_title' => 'Booking Page Table',
            'add_button' => 'Add New Booking Page',
            'action' => route('cms.booking-page.create')
        ]);
    }

    public function create()
    {
        session(['activeTab' => 'bookingPageData']);
        return view('cms.booking-page.add-edit', [
            'action' => route('cms.booking-page.store'),
            'action_back' => route('cms.booking-page.index'),
            'title' => "Add New Gallery",
            'gallery_images' => [],
            'images' => BookingPageImage::active(),
        ]);
    }

    public function store(BookingPageRequest $request, BookingPage $bookingPage)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $bookingPage = new BookingPage();
            $bookingPage->page_name = $validated['page_name'];
            $bookingPage->is_active = 1;
            $bookingPage->created_by = $user->id;
            $bookingPage->updated_by = $user->id;
            $bookingPage->save();

            $encryptedId = Crypt::encrypt($bookingPage->id);
            return Redirect::route('cms.booking-page.edit', $encryptedId)
                            ->with('success', 'The new booking page was added successfully')
                            ->with('activeTab', 'bookingPageImage');
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $gallery = getDecryptedModelId($encryptedId, BookingPage::class);
        $galleryName = BookingPage::where('id', $gallery->id)->pluck('page_name')->first();
        $galleryImages = BookingPageImage::imagesByPage($gallery->id);

        return view('cms.booking-page.add-edit', [
            'action' => $action,
            'action_back' => route('cms.booking-page.index'),
            'record' => $gallery,
            'title' => $title . ' ' . $galleryName,
            'gallery_images' => $galleryImages ?? '',
            'galleries' => BookingPageImage::active(),
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail Booking Page');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('cms.booking-page.update', $encryptedId), 'Edit Booking Page');
    }

    public function update(BookingPageRequest $request, $encryptedId)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, BookingPage::class);
            $bookingPage = BookingPage::find($data->id);

            $bookingPage->page_name = $validated->page_name;

            $bookingPage->updated_by = $user->id;
            $bookingPage->is_active = 1;
            $bookingPage->save();

            return responseSuccess('update', route('cms.booking-page.index'));

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, BookingPage::class);
            $bookingPage = BookingPage::find($data->id);

            $bookingPage->deleted_by = $user->id;
            $bookingPage->is_active = 0;
            $bookingPage->save();
            $bookingPage->delete();
            return responseSuccess('delete', route('cms.booking-page.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Auth::user()->can('delete cms/booking-page')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete booking page"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $id) {
                $bookingPage = BookingPage::find($id);
                $bookingPage->deleted_by = Auth::user()->id;
                $bookingPage->is_active = 0;
                $bookingPage->save();
                $bookingPage->delete();
            }

            DB::commit();
            return responseJsonSuccess("Booking page has been successfully deleted");
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
        $data = getDecryptedModelId($encryptedId, BookingPage::class);
        $bookingPage = BookingPage::find($data->id);

        $basePath = public_path("assets/pbc/images/booking-page/");
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
            $newImage = BookingPageImage::create([
                'booking_page_id' => $bookingPage->id,
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
            $filePath = "assets/pbc/images/booking-page/" . $fileName;
            $fileSize = filesize($basePath . "/" . $fileName);

            $newImage->update([
                'file_path' => $filePath,
                'file_name' => $fileName,
                'file_size' => $fileSize,
            ]);
        }

        session(['activeTab' => 'bookingPageImage']);
        return redirect()->back();
    }

    public function updateDefaultImage(Request $request, $imageId)
    {
        try {
            $encryptedId = $request->input('encrypted');
            $data = getDecryptedModelId($encryptedId, BookingPage::class);
            $imageDefault = BookingPageImage::where('booking_page_id', $data->id)->where('is_default', true)->first();

            if ($imageDefault) {
                $imageDefault->is_default = false;
                $imageDefault->updated_by = Auth::user()->id;
                $imageDefault->save();
            }

            $image = BookingPageImage::find($imageId);
            if ($image) {
                $image->is_default = $request->is_default;
                $image->updated_by = Auth::user()->id;
                $image->save();
            }

            session(['activeTab' => 'bookingPageImage']);
            return response()->json([
                'success' => true,
                'status_code' => 200,
                'message' => 'Image default status updated successfully'
            ], 200);
        } catch (\Throwable $e) {
            session(['activeTab' => 'bookingPageImage']);
            return response()->json([
                'success' => false,
                'status_code' => 500,
                'message' => 'Failed to updated status'
            ], 500);
        }
    }

    public function deleteBookingPageImage(Request $request, $imageId)
    {
        try {
            $imageId = $request->segment(3);
            $user = Auth::user();
            $image = BookingPageImage::find($imageId);
            $image->deleted_by = $user->id;
            $image->is_active = 0;
            $image->save();
            $image->delete();

            session(['activeTab' => 'bookingPageImage']);
            return redirect()->back()->with('success', 'Booking page image has been deleted successfully');
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }
}
