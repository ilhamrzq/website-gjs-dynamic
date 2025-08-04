<?php

namespace App\Http\Controllers\CMS;

use App\DataTables\CMS\LocalAreaDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\LocalAreaRequest;
use App\Http\Requests\CMS\LocalAreaRequestEdit;
use App\Models\CMS\LocalArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class LocalAreaController extends Controller
{
    public function index(LocalAreaDataTable $dataTable)
    {
        return $dataTable->render('cms.local-areas.index', [
            'table_title' => 'Local Area Table',
            'add_button' => 'Add New Local Area',
            'action' => route('cms.local-areas.create')
        ]);
    }

    public function create()
    {
        return view('cms.local-areas.add-edit', [
            'action' => route('cms.local-areas.store'),
            'action_back' => route('cms.local-areas.index'),
            'title' => 'Add New Local Area',
            'record' => null,
        ]);
    }

    public function store(LocalAreaRequest $request, LocalArea $localArea)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $localAreaFile = $request->file('image');

            $basePath = public_path("assets/pbc/images/local-areas/" );
            if (!File::exists($basePath)) {
                File::makeDirectory($basePath, 0755, true, true);
            }

            // Nama file berdasarkan datetime
            $fileName = now()->format('Ymd_His') . '.' . $localAreaFile->getClientOriginalExtension();
            $localAreaFile->move($basePath, $fileName);

            $filePath = "assets/pbc/images/local-areas/" . $fileName;
            $fileSize = filesize($basePath . "/" . $fileName);

            $localArea = new LocalArea();
            $localArea->place_name = $validated['place_name'];
            $localArea->file_path = $filePath;
            $localArea->file_name = $fileName;
            $localArea->file_size = $fileSize;
            $localArea->created_by = $user->id;
            $localArea->updated_by = $user->id;
            $localArea->is_active = 1;
            $localArea->save();

            // Redirect ke edit (opsional)
            $encryptedId = Crypt::encrypt($localArea->id);
            return Redirect::route('cms.local-areas.index', $encryptedId)
                            ->with('success', 'The new local area was added successfully')
                            ->with('activeTab', 'localAreaMenu');

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $localArea = getDecryptedModelId($encryptedId, LocalArea::class);
        $localAreaName = $localArea->place_name;

        return view('cms.local-areas.add-edit', [
            'action' => $action,
            'action_back' => route('cms.local-areas.index'),
            'record' => $localArea,
            'title' => $title . ' ' . $localAreaName,
            'image_name' => $localAreaName,
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail Local Area');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('cms.local-areas.update', $encryptedId), 'Edit Local Area');
    }

    public function update(LocalAreaRequestEdit $request, $encryptedId)
    {
        try {
            $user = Auth::user();
            
            $validated = $request->validated();

            $data = getDecryptedModelId($encryptedId, LocalArea::class);
            $localArea = LocalArea::findOrFail($data->id);

            if ($request->hasFile('image')) {
                $uploadedFile = $request->file('image');
                $basePath = public_path("assets/pbc/images/local-areas/");

                if (!File::exists($basePath)) {
                    File::makeDirectory($basePath, 0755, true);
                }

                $fileName = now()->format('Ymd_His') . '.' . $uploadedFile->getClientOriginalExtension();
                $uploadedFile->move($basePath, $fileName);

                $filePath = "assets/pbc/images/local-areas/" . $fileName;
                $fileSize = filesize($basePath . "/" . $fileName);

                $localArea->file_path = $filePath;
                $localArea->file_name = $fileName;
                $localArea->file_size = $fileSize;
            }

            $localArea->place_name = $validated['place_name'];
            $localArea->updated_by = $user->id;
            $localArea->is_active = 1;
            $localArea->save();

            return responseSuccess('update', route('cms.local-areas.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, LocalArea::class);
            $localArea = LocalArea::find($data->id);

            $localArea->deleted_by = $user->id;
            $localArea->is_active = 0;
            $localArea->save();
            $localArea->delete();
            return responseSuccess('delete', route('cms.local-areas.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Auth::user()->can('delete cms/local-areas')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete local area data"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $id) {
                $localArea = LocalArea::find($id);
                $localArea->deleted_by = Auth::user()->id;
                $localArea->is_active = 0;
                $localArea->save();
                $localArea->delete();
            }

            DB::commit();
            return responseJsonSuccess("Local area data has been successfully deleted");
        } catch (\Throwable $e) {
            DB::rollBack();
            return responseJsonError($e);
        }
    }
}
