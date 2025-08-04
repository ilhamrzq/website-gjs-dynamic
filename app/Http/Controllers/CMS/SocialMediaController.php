<?php

namespace App\Http\Controllers\CMS;

use App\DataTables\CMS\SocialMediaDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\SocialMediaRequest;
use App\Models\CMS\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class SocialMediaController extends Controller
{
    public function index(SocialMediaDataTable $dataTable)
    {
        return $dataTable->render('cms.social-media.index', [
            'table_title' => 'Social Media Table',
            'add_button' => 'Add New Social Media',
            'action' => route('cms.social-media.create')
        ]);
    }

    public function create()
    {
        session(['activeTab' => 'socmedData']);
        return view('cms.social-media.add-edit', [
            'action' => route('cms.social-media.store'),
            'action_back' => route('cms.social-media.index'),
            'title' => "Add New Social Media",
        ]);
    }

    public function store(SocialMediaRequest $request, SocialMedia $socmed)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $socmed = new SocialMedia();
            $socmed->socmed_name = $validated['socmed_name'];
            $socmed->socmed_icon = $validated['socmed_icon'];
            $socmed->socmed_url = $validated['socmed_url'];
            $socmed->socmed_username = $validated['socmed_username'];
            $socmed->created_by = $user->id;
            $socmed->updated_by = $user->id;
            $socmed->is_active = 1;
            $socmed->save();

            $encryptedId = Crypt::encrypt($socmed->id);
            return Redirect::route('cms.social-media.index', $encryptedId)
                            ->with('success', 'The new social media was added successfully');

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $socmed = getDecryptedModelId($encryptedId, SocialMedia::class);
        $socmedName = SocialMedia::where('id', $socmed->id)->pluck('socmed_name')->first();

        return view('cms.social-media.add-edit', [
            'action' => $action,
            'action_back' => route('cms.social-media.index'),
            'record' => $socmed,
            'title' => $title . ' ' . $socmedName,
            'socmed_name' => $socmedName,
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail Social Media');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('cms.social-media.update', $encryptedId), 'Edit Social Media');
    }

    public function update(SocialMediaRequest $request, $encryptedId)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, SocialMedia::class);
            $socmed = SocialMedia::find($data->id);

            $socmed->socmed_name = $validated['socmed_name'];
            $socmed->socmed_icon = $validated['socmed_icon'];
            $socmed->socmed_url = $validated['socmed_url'];
            $socmed->socmed_username = $validated['socmed_username'];
            $socmed->updated_by = $user->id;
            $socmed->is_active = 1;
            $socmed->save();

            return responseSuccess('update', route('cms.social-media.index'));

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, SocialMedia::class);
            $socmed = SocialMedia::find($data->id);

            $socmed->deleted_by = $user->id;
            $socmed->is_active = 0;
            $socmed->save();
            $socmed->delete();
            return responseSuccess('delete', route('cms.social-media.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Auth::user()->can('delete cms/social-media')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete social media"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $id) {
                $socmed = SocialMedia::find($id);
                $socmed->deleted_by = $user->id;
                $socmed->is_active = 0;
                $socmed->save();
                $socmed->delete();
            }

            DB::commit();
            return responseJsonSuccess("Social media data has been successfully deleted");
        } catch (\Throwable $e) {
            DB::rollBack();
            return responseJsonError($e);
        }
    }
}
