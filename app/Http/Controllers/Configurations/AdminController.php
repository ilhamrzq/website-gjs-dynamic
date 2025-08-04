<?php

namespace App\Http\Controllers\Configurations;

use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Configurations\AdminCreateRequest;
use App\Http\Requests\Configurations\AdminEditRequest;
use App\Http\Requests\Configurations\AdminRequest;
use App\Models\Configuration\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function index(AdminDataTable $dataTable)
    {
        return $dataTable->render('configurations.admin.index', [
            'table_title' => 'Admin Table',
            'add_button' => 'Add New Admin',
            'action' => route('configurations.admin.create')
        ]);
    }

    public function create()
    {
        session(['activeTab' => 'adminData']);

        return view('configurations.admin.add-edit', [
            'action' => route('configurations.admin.store'),
            'action_back' => route('configurations.admin.index'),
            'title' => "Add New Admin",
            'roles' => Role::active(),
            'admin_roles' => collect(),
        ]);
    }

    public function store(AdminCreateRequest $request, User $admin)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $admin = new User();
            $admin->name = $validated['name'];
            $admin->email = $validated['email'];
            $admin->phone = $validated['phone'];
            $admin->password = $validated['password'];
            $admin->created_by = $user->id;
            $admin->updated_by = $user->id;
            $admin->save();

            // $role = Role::find($validated['role_id']);

            // $admin->assignRole($role->name);

            if (isset($validated['roles']) && is_array($validated['roles'])) {
                // Ambil role names dari IDs
                $roleNames = Role::whereIn('id', $validated['roles'])->pluck('name')->toArray();
    
                // Sync roles ke user, otomatis hapus role lama yang tidak ada di array ini
                $admin->syncRoles($roleNames);
            } else {
                // Jika tidak ada roles dipilih, hapus semua roles user
                $admin->syncRoles([]);
            }

            $encryptedId = Crypt::encrypt($admin->id);
            return Redirect::route('configurations.admin.index', $encryptedId)
                            ->with('success', 'The new admin was added successfully');

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $admin = getDecryptedModelId($encryptedId, User::class);
        $adminName = User::where('id', $admin->id)->pluck('name')->first();

        $adminRoles = $admin->roles;

        return view('configurations.admin.add-edit', [
            'action' => $action,
            'action_back' => route('configurations.admin.index'),
            'record' => $admin,
            'title' => $title . ' ' . $adminName,
            'admin_name' => $adminName,
            'roles' => Role::active(),
            'admin_roles' => $adminRoles,
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail Admin');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('configurations.admin.update', $encryptedId), 'Edit Admin');
    }

    public function update(AdminEditRequest $request, $encryptedId)
    {
        try {
            $admin = Auth::user();
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, User::class);
            $admin = User::find($data->id);

            $admin->name = $validated['name'];

            if ($validated['email'] !== $admin->email) {
                $admin->email = $validated['email'];
            }

            if ($validated['phone'] !== $admin->phone) {
                $admin->phone = $validated['phone'];
            }

            if (!empty($validated['password'])) {
                $admin->password = $validated['password'];
            }
            $admin->updated_by = $admin->id;
            $admin->save();

            // $role = Role::find($validated['role_id']);

            // $admin->assignRole($role->name);

            if (isset($validated['roles']) && is_array($validated['roles'])) {
                // Ambil role names dari IDs
                $roleNames = Role::whereIn('id', $validated['roles'])->pluck('name')->toArray();
    
                // Sync roles ke user, otomatis hapus role lama yang tidak ada di array ini
                $admin->syncRoles($roleNames);
            } else {
                // Jika tidak ada roles dipilih, hapus semua roles user
                $admin->syncRoles([]);
            }

            return responseSuccess('update', route('configurations.admin.index'));

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, User::class);
            $admin = User::find($data->id);

            $admin->deleted_by = $user->id;
            $admin->save();
            $admin->delete();
            return responseSuccess('delete', route('configurations.admin.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Auth::user()->can('delete configurations/admin')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete this admin"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $id) {
                $admin = User::find($id);
                $admin->deleted_by = $user->id;
                $admin->save();
                $admin->delete();
            }

            DB::commit();
            return responseJsonSuccess("Admin data has been successfully deleted");
        } catch (\Throwable $e) {
            DB::rollBack();
            return responseJsonError($e);
        }
    }
}
