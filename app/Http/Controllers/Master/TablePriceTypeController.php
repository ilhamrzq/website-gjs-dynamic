<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\TablePriceTypeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\TablePriceTypeRequest;
use App\Models\Master\TablePriceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TablePriceTypeController extends Controller
{
    public function index(TablePriceTypeDataTable $dataTable)
    {
        return $dataTable->render('tables.price-type.index', [
            'table_title' => 'Table Price Type Table',
            'add_button' => 'Add New Table Price Type',
            'action' => route('tables.price.type.create')
        ]);
    }

    public function create()
    {
        return view('tables.price-type.add-edit', [
            'action' => route('tables.price.type.store'),
            'action_back' => route('tables.price.type.index'),
            'title' => "Add New Price Type"
        ]);
    }

    public function store(TablePriceTypeRequest $request, TablePriceType $priceType)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $priceType = new TablePriceType();
            $priceType->price_type_name = $validated['price_type_name'];
            $priceType->price_type_description = $validated['price_type_description'];
            $priceType->created_by = $user->id;
            $priceType->updated_by = $user->id;
            $priceType->is_active = 1;
            $priceType->save();

            return responseSuccess('store', route('tables.price.type.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $priceType = getDecryptedModelId($encryptedId, TablePriceType::class);
        return view('tables.price-type.add-edit', [
            'action' => $action,
            'action_back' => route('tables.price.type.index'),
            'record' => $priceType,
            'title' => $title . ' ' . $priceType->price_type_name
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('tables.price.type.update', $encryptedId), 'Edit');
    }

    public function update(TablePriceTypeRequest $request, $encryptedId)
    {
        try {
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, TablePriceType::class);

            $priceType = TablePriceType::findOrFail($data->id);
            $priceType->price_type_name = $validated['price_type_name'];
            $priceType->price_type_description = $validated['price_type_description'];
            $priceType->updated_by = Auth::user()->id;
            $priceType->save();

            return responseSuccess('update', route('tables.price.type.index'));

        } catch (\Throwable $e) {
            responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $data = getDecryptedModelId($encryptedId, TablePriceType::class);
            $priceType = TablePriceType::findOrFail($data->id);

            $priceType->deleted_by = Auth::user()->id;
            $priceType->is_active = 0;
            $priceType->save();
            $priceType->delete();

            return responseSuccess('delete', route('tables.price.type.index'));

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            if (!Auth::user()->can('delete tables/price/type')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete tables price type"
                ], 401);
            }

            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $data) {
                $priceType = TablePriceType::findOrFail($data);
                $priceType->deleted_by = Auth::user()->id;
                $priceType->is_active = 0;
                $priceType->save();
                $priceType->delete();
            }

            return responseJsonSuccess("Tables price type data has been successfully deleted");
        } catch (\Throwable $e) {
            return responseJsonError($e);
        }
    }
}
