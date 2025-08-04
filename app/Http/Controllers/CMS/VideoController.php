<?php

namespace App\Http\Controllers\CMS;

use App\DataTables\CMS\VideoDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\VideoRequest;
use App\Http\Requests\CMS\VideoRequestEdit;
use App\Models\CMS\Video;
use App\Models\Master\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;


class VideoController extends Controller
{
    public function index(VideoDataTable $dataTable)
    {
        return $dataTable->render('cms.video.index', [
            'table_title' => 'Video Table',
            'add_button' => 'Add New Video',
            'action' => route('cms.videos.create')
        ]);
    }

    public function create()
    {
        return view('cms.video.add-edit', [
            'action' => route('cms.videos.store'),
            'action_back' => route('cms.videos.index'),
            'title' => 'Add New Homepage',
            'languages' => Language::active(),
            'record' => null,
        ]);
    }

    public function store(VideoRequest $request, Video $video)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $videoFile = $request->file('video');

            $basePath = public_path("assets/pbc/videos/video-galleries/" );
            if (!File::exists($basePath)) {
                File::makeDirectory($basePath, 0755, true, true);
            }

            // Nama file berdasarkan datetime
            $fileName = now()->format('Ymd_His') . '.' . $videoFile->getClientOriginalExtension();
            $videoFile->move($basePath, $fileName);

            $filePath = "assets/pbc/videos/video-galleries/" . $fileName;
            $fileSize = filesize($basePath . "/" . $fileName);

            $video = new Video();
            $video->video_title_id = $validated['video_title_id'];
            $video->video_title_en = $validated['video_title_en'];
            $video->file_path = $filePath;
            $video->file_name = $fileName;
            $video->file_size = $fileSize;
            $video->created_by = $user->id;
            $video->updated_by = $user->id;
            $video->is_active = 1;
            $video->save();

            // Redirect ke edit (opsional)
            $encryptedId = Crypt::encrypt($video->id);
            return Redirect::route('cms.videos.index', $encryptedId)
                            ->with('success', 'The new video was added successfully')
                            ->with('activeTab', 'videoMenu');

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $video = getDecryptedModelId($encryptedId, Video::class);
        $videoName = $video->video_title;

        return view('cms.video.add-edit', [
            'action' => $action,
            'action_back' => route('cms.videos.index'),
            'record' => $video,
            'title' => $title . ' ' . $videoName,
            'video_name' => $videoName,
            "languages" => Language::active(),
            'selectedLangId' => $video->lang_id
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail Video');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('cms.videos.update', $encryptedId), 'Edit Video');
    }

    public function update(VideoRequestEdit $request, $encryptedId)
    {
        try {
            $user = Auth::user();
            
            $validated = $request->validated();

            $data = getDecryptedModelId($encryptedId, Video::class);
            $video = Video::findOrFail($data->id);

            if ($request->hasFile('video')) {
                $uploadedFile = $request->file('video');
                $basePath = public_path("assets/pbc/videos/video-galleries/");

                if (!File::exists($basePath)) {
                    File::makeDirectory($basePath, 0755, true);
                }

                $fileName = now()->format('Ymd_His') . '.' . $uploadedFile->getClientOriginalExtension();
                $uploadedFile->move($basePath, $fileName);

                $filePath = "assets/pbc/videos/video-galleries/" . $fileName;
                $fileSize = filesize($basePath . "/" . $fileName);

                $video->file_path = $filePath;
                $video->file_name = $fileName;
                $video->file_size = $fileSize;
            }

            $video->video_title_id = $validated['video_title_id'];
            $video->video_title_en = $validated['video_title_en'];
            $video->updated_by = $user->id;
            $video->is_active = 1;
            $video->save();

            return responseSuccess('update', route('cms.videos.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, Video::class);
            $video = Video::find($data->id);

            $video->deleted_by = $user->id;
            $video->is_active = 0;
            $video->save();
            $video->delete();
            return responseSuccess('delete', route('cms.videos.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Auth::user()->can('delete cms/videos')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete video data"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $id) {
                $video = Video::find($id);
                $video->deleted_by = Auth::user()->id;
                $video->is_active = 0;
                $video->save();
                $video->delete();
            }

            DB::commit();
            return responseJsonSuccess("Video data has been successfully deleted");
        } catch (\Throwable $e) {
            DB::rollBack();
            return responseJsonError($e);
        }
    }
}