<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\ProductDiscountTypeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\ProductDiscountTypeRequest;
use App\Models\Master\ProductDiscountType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductDiscountTypeController extends Controller
{
    public function index(ProductDiscountTypeDataTable $dataTable)
    {
        return $dataTable->render('product.discount-type.index', [
            'table_title' => 'Product Discount Type Table',
            'add_button' => 'Add New Discount Type',
            'action' => route('products.discount.type.create')
        ]);
    }

    public function create()
    {
        return view('product.discount-type.add-edit', [
            'action' => route('products.discount.type.store'),
            'action_back' => route('products.discount.type.index'),
            'title' => "Add New Discount Type"
        ]);
    }

    public function store(ProductDiscountTypeRequest $request)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $discountType = new ProductDiscountType();
            $discountType->discount_type_name = $validated['discount_type_name'];
            $discountType->discount_type_description = $validated['discount_type_description'];
            $discountType->created_by = $user->id;
            $discountType->updated_by = $user->id;
            $discountType->is_active = 1;
            $discountType->save();

            return responseSuccess('store', route('products.discount.type.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $discountType = getDecryptedModelId($encryptedId, ProductDiscountType::class);
        return view('product.discount-type.add-edit', [
            'action' => $action,
            'action_back' => route('products.discount.type.index'),
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
        return $this->editShow($encryptedId, route('products.discount.type.update', $encryptedId), 'Edit');
    }

    public function update(ProductDiscountTypeRequest $request, $encryptedId)
    {
        try {
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, ProductDiscountType::class);

            $discountType = ProductDiscountType::findOrFail($data->id);
            $discountType->discount_type_name = $validated['discount_type_name'];
            $discountType->discount_type_description = $validated['discount_type_description'];
            $discountType->updated_by = Auth::user()->id;
            $discountType->save();

            return responseSuccess('update', route('products.discount.type.index'));

        } catch (\Throwable $e) {
            responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $data = getDecryptedModelId($encryptedId, ProductDiscountType::class);
            $discountType = ProductDiscountType::findOrFail($data->id);

            $discountType->deleted_by = Auth::user()->id;
            $discountType->is_active = 0;
            $discountType->save();
            $discountType->delete();

            return responseSuccess('delete', route('products.discount.type.index'));

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            if (!Auth::user()->can('delete products/discount/type')) {
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
                $discountType = ProductDiscountType::findOrFail($data);
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
