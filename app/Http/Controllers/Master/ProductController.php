<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductImageRequest;
use App\Http\Requests\Master\ProductRequest;
use App\Models\Master\Product;
use App\Models\Master\ProductDiscountType;
use App\Models\Product\ProductImage;
use App\Models\Master\ProductPriceType;
use App\Models\Product\ProductCategory;
use App\Models\Relation\RelProductDiscount;
use App\Models\Relation\RelProductPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('product.item.index', [
            'table_title' => 'Products Items Table',
            'add_button' => 'Add New Products Items',
            'action' => route('products.items.create')
        ]);
    }

    public function create()
    {
        session(['activeTab' => 'productItemData']);

        return view('product.item.add-edit', [
            'action' => route('products.items.store'),
            'action_back' => route('products.items.index'),
            'title' => "Add New Products Items",
            'product_item_images' => [],
            'categories' => ProductCategory::active(),
            'price_types' => ProductPriceType::active(),
            'discount_types' => ProductDiscountType::active(),
        ]);
    }

    public function store(ProductRequest $request, Product $product)
    {
        try {
            $user = Auth::user();
            $validated = $request->validated();

            $product = new Product();
            $product->product_category_id = $validated['product_category_id'];
            $product->product_name = $validated['product_name'];
            $product->product_description = $validated['product_description'];
            $product->product_stock = $validated['product_stock'];
            $product->product_slug = Str::slug($validated['product_name']);
            $product->created_by = $user->id;
            $product->updated_by = $user->id;
            $product->is_active = 1;
            $product->save();

            $priceData = $validated['price_data'] ?? [];

            foreach ($priceData as $key => $price) {
                // Extract price_type_id from the key (e.g., "1_Retail_Price" => 10000)
                $priceTypeId = explode('_', $key)[0]; // Get the ID part

                RelProductPrice::create([
                    'product_id' => $product->id,
                    'price_type_id' => $priceTypeId,
                    'price' => $price,
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                    'is_active' => 1,
                ]);
            }

            $discountData = $validated['discount_data'] ?? [];

            foreach ($discountData as $key => $discount) {
                // Extract discount_type_id from the key (e.g., "1_Retail_Discount" => 10000)
                $discountTypeId = explode('_', $key)[0]; // Get the ID part

                RelProductDiscount::create([
                    'product_id' => $product->id,
                    'discount_type_id' => $discountTypeId,
                    'discount' => $discount,
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                    'is_active' => 1,
                ]);
            }

            $encryptedId = Crypt::encrypt($product->id);
            return Redirect::route('products.items.edit', $encryptedId)
                            ->with('success', 'The new product item was added successfully')
                            ->with('activeTab', 'productItemImages');

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function editShow($encryptedId, $action, $title)
    {
        $product = getDecryptedModelId($encryptedId, Product::class);
        $productItemImages = ProductImage::imagesByProduct($product->id);
        $productName = Product::where('id', $product->id)->pluck('product_name')->first();

        $productPrices = RelProductPrice::where('product_id', $product->id)->get();

        $priceData = [];
        foreach ($productPrices as $price) {
            $key = $price->price_type_id . '_' . str_replace(' ', '_', $price->priceType->price_type_name);
            $priceData[$key] = $price->price;
        }

        $productDiscounts = RelProductDiscount::where('product_id', $product->id)->get();

        $discountData = [];
        foreach ($productDiscounts as $discount) {
            $key = $discount->discount_type_id . '_' . str_replace(' ', '_', $discount->discountType->discount_type_name);
            $discountData[$key] = $discount->discount;
        }

        return view('product.item.add-edit', [
            'action' => $action,
            'action_back' => route('products.items.index'),
            'record' => $product,
            'title' => $title . ' ' . $product->product_name,
            'product_item_images' => $productItemImages ?? '',
            'product_name' => $productName,
            'categories' => ProductCategory::active(),
            'price_types' => ProductPriceType::active(),
            'discount_types' => ProductDiscountType::active(),
            'price_data' => $priceData,
            'discount_data' => $discountData,
        ]);
    }

    public function show($encryptedId)
    {
        return $this->editShow($encryptedId, '', 'Detail Product Item');
    }

    public function edit($encryptedId)
    {
        return $this->editShow($encryptedId, route('products.items.update', $encryptedId), 'Edit Product Item');
    }

    public function update(ProductRequest $request, $encryptedId)
    {
        try {
            // dd($request->validated());
            $user = Auth::user();
            $validated = $request->validated();
            $data = getDecryptedModelId($encryptedId, Product::class);
            
            $product = Product::find($data->id);
            $product->product_category_id = $validated['product_category_id'];
            $product->product_name = $validated['product_name'];
            $product->product_description = $validated['product_description'];
            $product->product_stock = $validated['product_stock'];
            $product->product_slug = Str::slug($validated['product_name']);
            $product->updated_by = $user->id;
            $product->is_active = 1;
            $product->save();

            $priceData = $validated['price_data'] ?? [];

            foreach ($priceData as $key => $price) {
                if (!is_numeric($price)) continue;
                // Extract price_type_id from the key (e.g., "1_Retail_Price" => 10000)
                $priceTypeId = explode('_', $key)[0]; // Get the ID part

                RelProductPrice::create([
                    'product_id' => $product->id,
                    'price_type_id' => $priceTypeId,
                    'price' => $price,
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                    'is_active' => 1,
                ]);
            }

            $discountData = $validated['discount_data'] ?? [];

            foreach ($discountData as $key => $discount) {
                if (!is_numeric($discount)) continue;
                // Extract discount_type_id from the key (e.g., "1_Retail_Price" => 10000)
                $discountTypeId = explode('_', $key)[0]; // Get the ID part

                RelProductDiscount::create([
                    'product_id' => $product->id,
                    'discount_type_id' => $discountTypeId,
                    'discount' => $discount,
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                    'is_active' => 1,
                ]);
            }


            return responseSuccess('update', route('products.items.index'));

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function destroy($encryptedId)
    {
        try {
            $user = Auth::user();
            $data = getDecryptedModelId($encryptedId, Product::class);
            $product = Product::find($data->id);

            $product->deleted_by = $user->id;
            $product->is_active = 0;
            $product->save();
            $product->delete();
            return responseSuccess('delete', route('products.items.index'));
        } catch (\Throwable $e) {
            return responseError($e);
        }
    }

    public function multipleDestroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Auth::user()->can('delete products/items')) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => "This user do not have permission to delete products items"
                ], 401);
            }

            $user = Auth::user();
            $validated = $request->validate([
                'ids' => ['required', 'array', 'min:1'],
                'ids.*' => ['integer', 'distinct']
            ]);

            $datas = $validated['ids'];
            foreach ($datas as $id) {
                $productItem = Product::find($id);
                $productItem->deleted_by = Auth::user()->id;
                $productItem->is_active = 0;
                $productItem->save();
                $productItem->delete();

                $images = ProductImage::where('product_id', $id)->get();
                foreach ($images as $image) {
                    $productItemImage = ProductImage::find($image->id);
                    $productItemImage->deleted_by = $user->id;
                    $productItemImage->is_active = 0;
                    $productItemImage->save();
                    $productItemImage->delete();
                }
            }

            DB::commit();
            return responseJsonSuccess("Products items data has been successfully deleted");
        } catch (\Throwable $e) {
            DB::rollBack();
            return responseJsonError($e);
        }
    }

    public function uploadImages(ProductImageRequest $request)
    {
        $validated = $request->validated();
        $files = $validated['file'];
        $user = Auth::user();
        $encryptedId = $request->input('encrypted');
        $data = getDecryptedModelId($encryptedId, Product::class);
        $product = Product::find($data->id);
        $productName = $product->product_name;

        $basePath = public_path("assets/pbc/images/products/" . implode("_", explode(" ", strtolower($productName))));
        if (!File::exists($basePath)) {
            File::makeDirectory($basePath, 0755, true, true);
            // 0755 permission file buat linux 
            // awalan, mendanakan oktal
            // 7 (Read, Write, Execute - Owner; 
            // 5 Read, Execute - Group; 
            // 5 Read, Execute - Others)

            // true, artinya bisa membuat folder secara recursive (kalo subfolder di dalam basePath belom ada, nanti bakalan dibuat sama laravel)
            // agar Laravel tidak error jika folder sudah ada.
        }

        foreach ($files as $file) {
            $newProductImage = ProductImage::create([
                'product_id' => $product->id,
                'file_path' => '',
                'file_name' => '',
                'file_size' => 0,
                'is_default' => 0,
                'is_active' => 1,
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ]);

            $idFormatted = str_pad($newProductImage->id, 6, '0', STR_PAD_LEFT);
            $extension = $file->getClientOriginalExtension();
            $fileName = "{$idFormatted}.{$extension}";

            $file->move($basePath, $fileName);
            $filePath = "assets/pbc/images/products/" . implode("_", explode(" ", strtolower($productName))) . "/" . $fileName;
            $fileSize = filesize($basePath . "/" . $fileName);

            $newProductImage->update([
                'file_path' => $filePath,
                'file_name' => $fileName,
                'file_size' => $fileSize,
            ]);
        }

        session(['activeTab' => 'productItemImages']);
        return redirect()->back();
    }


    public function updateDefaultImage(Request $request, $imageId)
    {
        try {
            $encryptedId = $request->input('encrypted');
            $data = getDecryptedModelId($encryptedId, Product::class);
            $imageDefault = ProductImage::where('product_id', $data->id)->where('is_default', true)->first();

            if ($imageDefault) {
                $imageDefault->is_default = false;
                $imageDefault->updated_by = Auth::user()->id;
                $imageDefault->save();
            }

            $image = ProductImage::find($imageId);
            if ($image) {
                $image->is_default = $request->is_default;
                $image->updated_by = Auth::user()->id;
                $image->save();
            }

            session(['activeTab' => 'productItemImages']);
            return response()->json([
                'success' => true,
                'status_code' => 200,
                'message' => 'Image default status updated successfully'
            ], 200);
        } catch (\Throwable $e) {
            session(['activeTab' => 'productItemImages']);
            return response()->json([
                'success' => false,
                'status_code' => 500,
                'message' => 'Failed to updated status'
            ], 500);
        }
    }

    public function deleteProductImage(Request $request, $imageId)
    {
        try {
            $imageId = $request->segment(3);
            $user = Auth::user();
            $image = ProductImage::find($imageId);
            $image->deleted_by = $user->id;
            $image->is_active = 0;
            $image->save();
            $image->delete();

            session(['activeTab' => 'productItemImages']);
            return redirect()->back()->with('success', 'Product item image has been deleted successfully');

        } catch (\Throwable $e) {
            return responseError($e);
        }
    }
}
