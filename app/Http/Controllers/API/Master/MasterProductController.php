<?php

namespace App\Http\Controllers\API\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\Master\Product;
use App\Models\Master\Item;
use App\Models\Relation\BuildingHasProducts;

class MasterProductController extends Controller
{
    public function productByBuilding($building_id)
    {
        $building = Building::find($building_id);

        if (!$building) {
            return response()->json([
                'status' => 'failed',
                'status_code' => 404,
                'message' => 'Building not found'
            ], 404);
        }
        
        $productIds = BuildingHasProducts::where('building_id', $building_id)->pluck('product_id')->toArray();
        $products = Product::with(['productImages'])
                        ->active()
                        ->whereIn('id', $productIds)
                        ->orderBy('product_name')
                        ->get();

        $dataProducts = [];
        foreach ($products as $product) {
            $dataProducts[] = [
                'id' => $product->id,
                'product_name' => $product->product_name,
                'product_image_path' => $product->productImages->firstWhere('is_default', 1)?->file_path
            ];
        }
        
        $response = [
            'status' => 'success',
            'status_code' => 200,
            'message' => "All products from the $building->building_name were successfully obtained",
            'data' => [
                'products' => $dataProducts
            ]
        ];

        return response()->json($response, 200);
    }
}