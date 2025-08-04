<?php

namespace App\Http\Controllers\API\CMS;

use App\Http\Controllers\Controller;
use App\Models\Product\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::select(
            'id',
            'product_category_name'
        )
        ->orderBy('id','desc')
        ->get();

        return response()->json([
            'success' => true,
            'data' => $categories,
            'message' => 'Product categories retrieved successfully',
        ]);
    }
}
