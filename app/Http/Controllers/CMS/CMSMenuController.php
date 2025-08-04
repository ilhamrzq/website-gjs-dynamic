<?php

namespace App\Http\Controllers\CMS;

use App\DataTables\CMS\MenuDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\MenuRequest;
use App\Models\CMS\Menu;
use App\Models\Master\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class CMSMenuController extends Controller
{
    public function index(MenuDataTable $dataTable)
    {
        return $dataTable->render('cms.menu.index', [
            'table_title' => 'Menu Table',
            'add_button' => 'Add New Menu',
            'action' => route('cms.menu.create')
        ]);
    }

    public function create()
    {
        session(['activeTab' => 'menuData']);
        return view('cms.menu.add-edit', [
            'action' => route('cms.menu.store'),
            'action_back' => route('cms.menu.index'),
            'title' => 'Add New Menu',
            'languages' => Language::active(),
        ]);
    }

    public function store(MenuRequest $request, Menu $menu)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $menu = new Menu();
            $menu->lang_id = $validated['lang_id'];
            $menu->menu_name = ucfirst(strtolower($validated['menu_name']));
            $menu->menu_path = '/' . ltrim(strtolower($validated['menu_path']), '/');
            $menu->is_menu = isset($validated['is_menu']) && $validated['is_menu'] == '1' ? 1 : 0;
            $menu->created_by = $user->id;
            $menu->updated_by = $user->id;
            $menu->is_active = 1;
            $menu->save();

            $encryptedId = Crypt::encrypt($menu->id);
            return Redirect::route('cms.menu.index', $encryptedId)
                            ->with('success', 'The new menu was added successfully');

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $menu = getDecryptedModelId($encryptedId, Menu::class);
        $menuName = Menu::where('id', $menu->id)->pluck('menu_name')->first();

        return view('cms.menu.add-edit', [
            'action' => $action,
            'action_back' => route('cms.menu.index'),
            'record' => $menu,
            'title' => $title . ' ' . $menuName,
            'profile_name' => $menuName,
            'languages' => Language::active(),
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail Menu');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('cms.menu.update', $encryptedId), 'Edit Menu');
    }

    public function update(MenuRequest $request, $encryptedId)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, Menu::class);
            $menu = Menu::find($data->id);

            $menu->lang_id = $validated['lang_id'];
            $menu->menu_name = ucfirst(strtolower($validated['menu_name']));
            $menu->menu_path = '/' . ltrim(strtolower($validated['menu_path']), '/');
            $menu->is_menu = isset($validated['is_menu']) && $validated['is_menu'] == '1' ? 1 : 0;
            $menu->updated_by = $user->id;
            $menu->is_active = 1;
            $menu->save();

            return responseSuccess('update', route('cms.menu.index'));

        } catch (\Throwable $e) {
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
            $menu->is_active = 0;
            $menu->save();
            $menu->delete();
            return responseSuccess('delete', route('cms.menu.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Auth::user()->can('delete cms/menu')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete Menu"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $id) {
                $menu = Menu::find($id);
                $menu->deleted_by = Auth::user()->id;
                $menu->is_active = 0;
                $menu->save();
                $menu->delete();
            }

            DB::commit();
            return responseJsonSuccess("Menu data has been successfully deleted");
        } catch (\Throwable $e) {
            DB::rollBack();
            return responseJsonError($e);
        }
    }
}
