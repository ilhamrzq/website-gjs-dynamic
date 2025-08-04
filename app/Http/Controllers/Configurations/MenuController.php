<?php

namespace App\Http\Controllers\Configurations;

use App\DataTables\MenusDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Configurations\MenuRequest;
use App\Models\Configuration\Menu;
use App\Models\Configuration\Permission;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Mavinoo\Batch\BatchFacade;

class MenuController extends Controller
{
    public function index(MenusDataTable $dataTable)
    {
        return $dataTable->render('configurations.menus.index', [
            'table_title' => 'Menus Table',
            'add_button' => 'Add New Menu',
            'action' => route('configurations.menu.create'),
            'action_sort' => route('configurations.menu.sort')
        ]);
    }

    public function sort() 
    {
        $menus = Menu::getMenus();
        $data = [];
        $i = 0;
        foreach ($menus as $mm) {
            $i++;
            $data[] = ['id' => $mm->id, 'orders' => $i];
            foreach ($mm->subMenus as $sm) {
                $i++;
                $data[] = ['id' => $sm->id, 'orders' => $i];
            }
        }

        Cache::forget('menus');
        BatchFacade::update(new Menu(), $data, 'id');
        responseSuccess('update', route('configurations.menu.index'));
    }

    public function create()
    {
        return view('configurations.menus.add-edit', [
            'action' => route('configurations.menu.store'),
            'action_back' => route('configurations.menu.index'),
            'permissions' => [],
            'title' => "Add New Menu",
            'main_menus' => Menu::getMainMenus()
        ]);
    }

    public function icon()
    {
        return view('configurations.menus.icon');
    }

    public function store(MenuRequest $request, Menu $menu)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();
            $validated = $request->validated();

            $menu = new Menu();
            $menu->main_menu_id = $validated['main_menu_id'];
            $menu->name = $validated['name'];
            $menu->category = strtoupper($validated['category']);
            $menu->url = $validated['url'];
            $menu->icon = $validated['icon'];
            $menu->orders = $validated['orders'];
            $menu->created_by = $user->id;
            $menu->updated_by = $user->id;
            $menu->save();

            $menuPermissions = $validated['permissions'];
            foreach ($menuPermissions ?? [] as $permissions) {
                $permissionName = $permissions . " {$menu->url}";
                $newPermission = Permission::updateOrCreate(
                    ['name' => $permissionName],
                    ['guard_name' => 'web', 'created_by' => $user->id, 'updated_by' => $user->id]
                );

                $newPermission->menus()->attach($menu->id, [
                    'created_at' => now(), 'updated_at' => now(),
                    'created_by' => $user->id, 'updated_by' => $user->id,
                ]);
            }

            DB::commit();
            return responseSuccess('store', route('configurations.menu.index'));

        } catch (\Exception $e) {
            DB::rollBack();
            return responseError($e);
        }
    }

    private function editShow($encryptedId, $action, $title)
    {
        $menu = getDecryptedModelId($encryptedId, Menu::class);
        return view('configurations.menus.add-edit', [
            'action' => $action,
            'action_back' => route('configurations.menu.index'),
            'record' => $menu,
            'title' => $title . ' ' . $menu->name,
            'permissions' => $this->getMenuPermissions($menu),
            'main_menus' => Menu::getMainMenus()
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Show Menu');
    }

    public function edit($encryptedId)
    {
       return $this->editShow($encryptedId, route('configurations.menu.update', $encryptedId), 'Edit Menu');
    }

    private function getMenuPermissions(Menu $menu)
    {
        $existingPermisisons = $menu->permissions()->get();
        $permissions = [];

        foreach ($existingPermisisons as $permission) {
            $data = explode(" ", $permission->name);
            $permissions[] = $data[0];
        }

        return $permissions;
    }

    public function update(MenuRequest $request, $encryptedId)
    {
        try {
            
            DB::beginTransaction();
            $user = Auth::user();
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, Menu::class);
            $menu = Menu::find($data->id);

            if ($validated['level_menu'] === 'main_menu') {
                $menu->main_menu_id = null;
            } else {
                $menu->main_menu_id = $validated['main_menu_id'] ?? null;
            }

            $menu->name = $validated['name'];
            $menu->category = strtoupper($validated['category']);
            $menu->url = $validated['url'];
            $menu->icon = $validated['icon'];
            $menu->orders = $validated['orders'];
            $menu->created_by = $user->id;
            $menu->updated_by = $user->id;
            $menu->save();

            foreach ($validated['permissions'] ?? [] as $permission) {
                $updatePermission = Permission::updateOrCreate(
                    ['name' => $permission . " {$menu->url}"],
                    [
                        'name' => $permission . " {$menu->url}",
                        'guard_name' => 'web', 'created_by' => $user->id, 'updated_by' => $user->id
                    ]
                );
                
                $permissionToSync[$updatePermission->id] = [
                    'created_at' => now(), 'created_by' => $user->id,
                    'updated_at' => now(), 'updated_by' => $user->id
                ];
            }
            
            $menu->permissions()->sync($permissionToSync);
            DB::commit();
            return responseSuccess('update', route('configurations.menu.index'));

        } catch (\Throwable $e) {
            DB::rollBack();
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, Menu::class);
            $menu = Menu::find($data->id);
    
            $menu->deleted_by = $user->id;
            $menu->save();
            $menu->delete();
            return responseSuccess('delete', route('configurations.menu.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            
            if (!Auth::user()->can('delete configurations/menu')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete menu"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $data) {
                $menu = Menu::findOrFail($data);
                $menu->deleted_by = $user->id;
                $menu->save();
                $menu->delete();
            }

            return response()->json([
                'status' => 'success',
                'status_code' => 200,
                'message' => 'Data menu deleted successfully'
            ], 200);

            
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'status_code' => 400,
                'message' => 'Something Error : ' . $e->getMessage() 
            ], 400);
        }
    }
}
