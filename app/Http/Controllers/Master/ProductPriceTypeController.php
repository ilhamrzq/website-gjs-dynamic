<?php

namespace App\Http\Controllers\Master;


use App\DataTables\Master\ProductPriceTypeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\ProductPriceTypeRequest;
use App\Models\Master\ProductPriceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductPriceTypeController extends Controller
{
    public function index(ProductPriceTypeDataTable $dataTable)
    {
        return $dataTable->render('product.price-type.index', [
            'table_title' => 'Product Price Type Table',
            'add_button' => 'Add New Product Price Type',
            'action' => route('products.price.type.create')
        ]);
    }

    public function create()
    {
        return view('product.price-type.add-edit', [
            'action' => route('products.price.type.store'),
            'action_back' => route('products.price.type.index'),
            'title' => "Add New Price Type"
        ]);
    }

    public function store(ProductPriceTypeRequest $request, ProductPriceType $priceType)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $priceType = new ProductPriceType();
            $priceType->price_type_name = $validated['price_type_name'];
            $priceType->price_type_description = $validated['price_type_description'];
            $priceType->created_by = $user->id;
            $priceType->updated_by = $user->id;
            $priceType->is_active = 1;
            $priceType->save();

            return responseSuccess('store', route('products.price.type.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $priceType = getDecryptedModelId($encryptedId, ProductPriceType::class);
        return view('product.price-type.add-edit', [
            'action' => $action,
            'action_back' => route('products.price.type.index'),
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
        return $this->editShow($encryptedId, route('products.price.type.update', $encryptedId), 'Edit');
    }

    public function update(ProductPriceTypeRequest $request, $encryptedId)
    {
        try {
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, ProductPriceType::class);

            $priceType = ProductPriceType::findOrFail($data->id);
            $priceType->price_type_name = $validated['price_type_name'];
            $priceType->price_type_description = $validated['price_type_description'];
            $priceType->updated_by = Auth::user()->id;
            $priceType->save();

            return responseSuccess('update', route('products.price.type.index'));

        } catch (\Throwable $e) {
            responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $data = getDecryptedModelId($encryptedId, ProductPriceType::class);
            $priceType = ProductPriceType::findOrFail($data->id);

            $priceType->deleted_by = Auth::user()->id;
            $priceType->is_active = 0;
            $priceType->save();
            $priceType->delete();

            return responseSuccess('delete', route('products.price.type.index'));

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            if (!Auth::user()->can('delete products/price/type')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete products price type"
                ], 401);
            }

            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $data) {
                $priceType = ProductPriceType::findOrFail($data);
                $priceType->deleted_by = Auth::user()->id;
                $priceType->is_active = 0;
                $priceType->save();
                $priceType->delete();
            }

            return responseJsonSuccess("Products price type data has been successfully deleted");
        } catch (\Throwable $e) {
            return responseJsonError($e);
        }
    }
}
