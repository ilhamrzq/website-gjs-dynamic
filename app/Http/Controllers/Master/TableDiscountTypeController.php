<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\TableDiscountTypeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\TableDiscountTypeRequest;
use App\Models\Master\TableDiscountType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TableDiscountTypeController extends Controller
{
    public function index(TableDiscountTypeDataTable $dataTable)
    {
        return $dataTable->render('tables.discount-type.index', [
            'table_title' => 'Table Discount Type Table',
            'add_button' => 'Add New Discount Type',
            'action' => route('tables.discount.type.create')
        ]);
    }

    public function create()
    {
        return view('tables.discount-type.add-edit', [
            'action' => route('tables.discount.type.store'),
            'action_back' => route('tables.discount.type.index'),
            'title' => "Add New Discount Type"
        ]);
    }

    public function store(TableDiscountTypeRequest $request)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $discountType = new TableDiscountType();
            $discountType->discount_type_name = $validated['discount_type_name'];
            $discountType->discount_type_description = $validated['discount_type_description'];
            $discountType->created_by = $user->id;
            $discountType->updated_by = $user->id;
            $discountType->is_active = 1;
            $discountType->save();

            return responseSuccess('store', route('tables.discount.type.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $discountType = getDecryptedModelId($encryptedId, TableDiscountType::class);
        return view('tables.discount-type.add-edit', [
            'action' => $action,
            'action_back' => route('tables.discount.type.index'),
            'record' => $discountType,
            'title' => $title . ' ' . $discountType->discount_type_name
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('tables.discount.type.update', $encryptedId), 'Edit');
    }

    public function update(TableDiscountTypeRequest $request, $encryptedId)
    {
        try {
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, TableDiscountType::class);

            $discountType = TableDiscountType::findOrFail($data->id);
            $discountType->discount_type_name = $validated['discount_type_name'];
            $discountType->discount_type_description = $validated['discount_type_description'];
            $discountType->updated_by = Auth::user()->id;
            $discountType->save();

            return responseSuccess('update', route('tables.discount.type.index'));

        } catch (\Throwable $e) {
            responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $data = getDecryptedModelId($encryptedId, TableDiscountType::class);
            $discountType = TableDiscountType::findOrFail($data->id);

            $discountType->deleted_by = Auth::user()->id;
            $discountType->is_active = 0;
            $discountType->save();
            $discountType->delete();

            return responseSuccess('delete', route('tables.discount.type.index'));

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            if (!Auth::user()->can('delete tables/discount/type')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete discount types"
                ], 401);
            }

            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $data) {
                $discountType = TableDiscountType::findOrFail($data);
                $discountType->deleted_by = Auth::user()->id;
                $discountType->is_active = 0;
                $discountType->save();
                $discountType->delete();
            }

            return responseJsonSuccess("Discount type data has been successfully deleted");
        } catch (\Throwable $e) {
            return responseJsonError($e);
        }
    }
}
