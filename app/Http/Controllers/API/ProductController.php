<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductItemCollection;
use App\Models\Master\Product;
use App\Models\Product\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $name = request()->query('name', '');
        $requestedCategory = request()->query('category', '');
        $limit = request()->query('limit', 5);

        $category = $requestedCategory;

        // If no category is specified, we will use the first available category
        if (empty($category)) {
            $firstCategory = ProductCategory::orderBy('id')->first();
            $category = $firstCategory ? $firstCategory->product_category_name : '';
        }

        // Ensure limit is a valid number and within range
        $limit = is_numeric($limit) && $limit > 0 ? min($limit, 100): 5;
        $products = Product::with(['category', 'productItemImages', 'relPrice.priceType', 'relDiscount'])
                        ->when($name != '', function($query) use ($name) {
                            $query->whereRaw('LOWER(product_name) LIKE ?', ["%".strtolower($name)."%"]);
                        })
                        ->when($category != '', function($query) use ($category) {
                            $query->whereHas('category', function($q) use ($category) {
                                $q->where('product_category_name', $category);
                            });
                        })
                        ->paginate($limit);


        return response()->json([
            'meta' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
            ],
            'success' => true,
            'data' => new ProductItemCollection($products),
            'message' => 'Products retrieved successfully',
        ]);
    }
}
