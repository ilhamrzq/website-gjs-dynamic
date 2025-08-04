<?php

namespace App\Http\Controllers\Configurations;

use App\DataTables\RoleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Configurations\RoleRequest;
use App\Models\Configuration\Menu;
use App\Models\Configuration\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    public function index(RoleDataTable $dataTable)
    {
        return $dataTable->render('configurations.roles.index', [
            'table_title' => 'Roles Table',
            'add_button' => 'Add New Role',
            'action' => route('configurations.role.create')
            
        ]);
    }

    private function getMenus()
    {
        return Menu::with('permissions', 'subMenus.permissions')->whereNull('main_menu_id')->get();
    }

    public function getPermissionByRole(Role $role)
    {
        return view('configurations.roles.access-menu', [
            'record' => $role,
            'menus' => $this->getMenus()
        ]);
    }

    public function create()
    {
        session(['activeTab' => 'roleData']);
        $record = $record ?? null;
        return view('configurations.roles.add-edit', [
            'action' => route('configurations.role.store'),
            'action_back' => route('configurations.role.index'),
            'title' => 'Add New Role',
            'form_name' => 'Role Form',
            'list_roles' => [],
            'record' => $record,
            'roles' => Role::active(),
            'menus' => $this->getMenus(),
            'users' => User::active(),
            'user_roles' => '',
            'action_access_menu' => '',
            'action_role_user' => ''
        ]);
    }

    public function store(RoleRequest $request)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $role = new Role();
            $role->name = strtolower($validated['name']);
            $role->guard_name = strtolower($validated['guard_name']);
            $role->created_by = $user->id;
            $role->updated_by = $user->id;
            $role->save();

            $encryptedId = Crypt::encrypt($role->id);
            return Redirect::route('configurations.role.edit', $encryptedId)
                            ->with('success', 'Role Data Saved Successfully')
                            ->with('activeTab', 'roleAccessMenu');
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $role = getDecryptedModelId($encryptedId, Role::class);
        $listRoles = Role::where('id', '!=', $role->id)->get();
        $userRoles = User::role($role->name)->get();
        $listUsers = User::active();

        return view('configurations.roles.add-edit', [
            'action' => $action,
            'action_back' => route('configurations.role.index'),
            'record' => $role,
            'title' => $title,
            'menus' => $this->getMenus(),
            'list_roles' => $listRoles,
            'users' => $listUsers,
            'user_roles' => $userRoles,
            'action_access_menu' => route('configurations.role.permission.update', $encryptedId),
            'action_role_user' => route('configurations.role.user.update', $encryptedId)
        ]);
    }

    public function show($encryptedId)
    {
        session(['activeTab' => 'roleData']);
        return $this->editShow($encryptedId, '', 'Show Role');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('configurations.role.update', $encryptedId), 'Edit Role');
    }

    public function update(RoleRequest $request, $encryptedId)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, Role::class);

            $role = Role::find($data->id);
            $role->name = $validated['name'];
            $role->guard_name = $validated['guard_name'];
            $role->updated_by = $user->id;
            $role->save();

            return Redirect::route('configurations.role.edit', $encryptedId)
                            ->with('success', 'Role Data Updated Successfully')
                            ->with('activeTab', 'roleData');
            return responseSuccess('update', route('configurations.role.index'));
            
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function updateRoleMenu(Request $request, $encryptedId)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $role = getDecryptedModelId($encryptedId, Role::class);
            $role->syncPermissions($request->permissions);
            $role->update(['updated_by' => $user->id]);

            DB::commit();
            return Redirect::route('configurations.role.edit', $encryptedId)
                            ->with('success', 'Role Acess Menu Updated Successfully')
                            ->with('activeTab', 'roleAccessMenu');
        } catch (\Throwable $e) {
            DB::rollBack();
            return responseError($e);
        }
    }

    public function updateRoleUser(Request $request, $encryptedId)
    {
        try {
            // dd($request->all());
            DB::beginTransaction();
            $validated = $request->validate([
                'users' => 'nullable|array',
                'role' => 'required|exists:roles,name',
            ]);

            $role = Role::findByName($validated['role']);
            $currentUser = User::role($role->name)->pluck('id')->toArray();
            $users = $validated['users'] ?? [];

            // assign role to new users based on user request
            foreach ($users as $user) {
                $user = User::find($user);
                if ($user && !$user->hasRole($role->name)) {
                    $user->assignRole($role->name);
                } 
            }

            // remove role from user that don't match with user request
            $removeUsers = array_diff($currentUser, $users);
            foreach ($removeUsers as $user) {
                $user = User::find($user);
                $user->removeRole($role->name);
            }

            DB::commit();
            return Redirect::route('configurations.role.edit', $encryptedId)
                ->with('success', 'The role has been successfully configured')
                ->with('activeTab', 'roleUsers');

        } catch (\Throwable $e) {
            DB::rollBack();
            return responseError($e);
        }
    }

    public function destroy($encryptedId) 
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, Role::class);
            $role = Role::find($data->id);

            $role->deleted_by = $user->id;
            $role->save();
            $role->delete();
            return responseSuccess('delete', route('configurations.role.index'));

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDelete(Request $request)
    {
        $ids = $request->input('ids');
        dd($ids);
    }

}
