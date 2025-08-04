<?php

namespace App\Http\Controllers\Table;

use App\DataTables\Table\BilliardTableDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Table\BilliardTableRequest;
use App\Models\Master\BilliardTableCategory;
use App\Models\Table\BilliardTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class BilliardTableController extends Controller
{
    public function index(BilliardTableDataTable $dataTable)
    {
        return $dataTable->render('tables.lists.index', [
            'table_title' => 'Billiard Table Lists',
            'add_button' => 'Add New Billiard Table',
            'action' => route('tables.lists.create')
        ]);
    }

    public function create()
    {
        session(['activeTab' => 'billiardTableData']);
        return view('tables.lists.add-edit', [
            'action' => route('tables.lists.store'),
            'action_back' => route('tables.lists.index'),
            'title' => "Add New Billiard Table",
            'categories' => BilliardTableCategory::active(),
        ]);
    }

    public function store(BilliardTableRequest $request, BilliardTable $table)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $table = new BilliardTable();
            $table->table_category_id = $validated['table_category_id'];
            $table->table_name = $validated['table_name'];
            $table->created_by = $user->id;
            $table->updated_by = $user->id;
            $table->is_active = 1;
            $table->save();

            $encryptedId = Crypt::encrypt($table->id);
            return Redirect::route('tables.lists.index', $encryptedId)
                            ->with('success', 'The new billiard table was added successfully');

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $list = getDecryptedModelId($encryptedId, BilliardTable::class);
        $listName = BilliardTable::where('id', $list->id)->pluck('table_name')->first();

        return view('tables.lists.add-edit', [
            'action' => $action,
            'action_back' => route('tables.lists.index'),
            'record' => $list,
            'title' => $title . ' ' . $listName,
            'profile_name' => $listName,
            'categories' => BilliardTableCategory::active(),
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail Billiard Table');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('tables.lists.update', $encryptedId), 'Edit Billiard Table');
    }

    public function update(BilliardTableRequest $request, $encryptedId)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, BilliardTable::class);
            $list = BilliardTable::find($data->id);

            $list->table_category_id = $validated['table_category_id'];
            $list->table_name = $validated['table_name'];
            $list->updated_by = $user->id;
            $list->is_active = 1;
            $list->save();

            return responseSuccess('update', route('tables.lists.index'));

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, BilliardTable::class);
            $list = BilliardTable::find($data->id);

            $list->deleted_by = $user->id;
            $list->is_active = 0;
            $list->save();
            $list->delete();
            return responseSuccess('delete', route('tables.lists.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Auth::user()->can('delete tables/lists')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete Billiard Table"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $id) {
                $list = BilliardTable::find($id);
                $list->deleted_by = Auth::user()->id;
                $list->is_active = 0;
                $list->save();
                $list->delete();
            }

            DB::commit();
            return responseJsonSuccess("Billiard Table data has been successfully deleted");
        } catch (\Throwable $e) {
            DB::rollBack();
            return responseJsonError($e);
        }
    }
}
