<?php

namespace App\Http\Controllers\Product;

use App\DataTables\Product\ProductCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductCategoryRequest;
use App\Models\Product\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProductCategoryController extends Controller
{
    public function index(ProductCategoryDataTable $dataTable)
    {
        return $dataTable->render('product.category.index', [
            'table_title' => 'Products Categories Table',
            'add_button' => 'Add New Product Category',
            'action' => route('products.categories.create')
        ]);
    }

    public function create()
    {
        session(['activeTab' => 'productCategoryData']);
        return view('product.category.add-edit', [
            'action' => route('products.categories.store'),
            'action_back' => route('products.categories.index'),
            'title' => "Add New Product Category",
        ]);
    }

    public function store(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $productCategory = new ProductCategory();
            $productCategory->product_category_name = $validated['product_category_name'];
            $productCategory->created_by = $user->id;
            $productCategory->updated_by = $user->id;
            $productCategory->is_active = 1;
            $productCategory->save();

            $encryptedId = Crypt::encrypt($productCategory->id);
            return Redirect::route('products.categories.index', $encryptedId)
                            ->with('success', 'The new product category was added successfully');

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $productCategory = getDecryptedModelId($encryptedId, ProductCategory::class);
        $productCategoryName = ProductCategory::where('id', $productCategory->id)->pluck('product_category_name')->first();

        return view('product.category.add-edit', [
            'action' => $action,
            'action_back' => route('products.categories.index'),
            'record' => $productCategory,
            'title' => $productCategoryName,
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail Product Category');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('products.categories.update', $encryptedId), 'Edit Product Category');
    }

    public function update(ProductCategoryRequest $request, $encryptedId)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, ProductCategory::class);
            $productCategory = ProductCategory::find($data->id);

            $productCategory->product_category_name = $validated['product_category_name'];
            $productCategory->updated_by = $user->id;
            $productCategory->is_active = 1;
            $productCategory->save();

            return responseSuccess('update', route('products.categories.index'));

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, ProductCategory::class);
            $menu = ProductCategory::find($data->id);

            $menu->deleted_by = $user->id;
            $menu->is_active = 0;
            $menu->save();
            $menu->delete();
            return responseSuccess('delete', route('products.categories.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Auth::user()->can('delete products/categories')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete Product Category"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $id) {
                $productCategory = ProductCategory::find($id);
                $productCategory->deleted_by = Auth::user()->id;
                $productCategory->is_active = 0;
                $productCategory->save();
                $productCategory->delete();
            }

            DB::commit();
            return responseJsonSuccess("Product Category data has been successfully deleted");
        } catch (\Throwable $e) {
            DB::rollBack();
            return responseJsonError($e);
        }
    }
}
