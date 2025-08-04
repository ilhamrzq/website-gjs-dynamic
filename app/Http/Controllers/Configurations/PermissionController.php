<?php

namespace App\Http\Controllers\Configurations;

use App\DataTables\PermissionDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Configurations\PermissionRequest;
use App\Models\Configuration\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function index(PermissionDataTable $dataTable)
    {
        return $dataTable->render('configurations.permissions.index', [
            'table_title' => 'Permissions Table',
            'add_button' => 'Add New Permission',
            'action' => route('configurations.permission.create')
        ]);
    }

    public function create()
    {
        return view('configurations.permissions.add-edit', [
            'action' => route('configurations.permission.store'),
            'action_back' => route('configurations.permission.index'),
            'title' => "Add New Permission",
            'form_name' => "Permission Form"
        ]);
    }

    public function store(PermissionRequest $request)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $permission = new Permission();
            $permission->name = $validated['name'];
            $permission->guard_name = $validated['guard_name'];
            $permission->created_by = $user->id;
            $permission->updated_by = $user->id;
            $permission->save();

            return responseSuccess('store', route('configurations.permission.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $permission = getDecryptedModelId($encryptedId,Permission::class);
        return view('configurations.permissions.add-edit', [
            'action' => $action,
            'action_back' => route('configurations.permission.index'),
            'record' => $permission,
            'title' => $title
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Show Permission');
    }

    public function edit($encryptedId)
    {
       return $this->editShow($encryptedId, route('configurations.permission.update', $encryptedId), 'Edit Permission');
    }

    public function update(PermissionRequest $request, $encryptedId)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, Permission::class);

            $permission = Permission::find($data->id);
            $permission->name = $validated['name'];
            $permission->guard_name = $validated['guard_name'];
            $permission->updated_by = $user->id;
            $permission->save();

            return responseSuccess('update', route('configurations.permission.index'));

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, Permission::class);
            $permission = Permission::find($data->id);
            
            $permission->deleted_by = $user->id;
            $permission->save();
            $permission->delete();
            return responseSuccess('delete', route('configurations.permission.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);
            
            $datas = $validated['ids'];
            foreach ($datas as $data) {
                $permission = Permission::findOrFail($data);
                $permission->deleted_by = $user->id;
                $permission->save();
                $permission->delete();
            }

            return response()->json([
                'status' => 'success',
                'status_code' => 200,
                'message' => 'Data permission deleted successfully'
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'failed',
                'status_code' => 400,
                'message' => 'Something Error : ' . $e->getMessage()
            ], 400);
        }
    }
}
