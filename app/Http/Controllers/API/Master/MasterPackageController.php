<?php

namespace App\Http\Controllers\API\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\Master\PackageHeader;
use App\Models\Master\PackageDetail;
use App\Models\Master\Product;

class MasterPackageController extends Controller
{
    public function detailPackageByProduct($product_id)
    {
        $product = Product::find($product_id);

        if (!$product) {
            return response()->json([
                'status' => 'failed',
                'status_code' => 404,
                'message' => 'Product not found'
            ], 404);
        }

        $packages = PackageHeader::with([
            'items' => function ($query) {
                $query->select('master_items.id', 'master_items.item_name', 'master_items.item_icon');
            },
            'priceTypes' => function ($query) {
                $query->select('master_price_types.id', 'master_price_types.price_type_name');
            },
            'packageDetail:id,package_header_id,uom_id',
            'packageDetail.uom:id,measurement_name', 
            'product:id,product_name',
            'product.productImages:product_id,file_path,is_default',
            'packageInventories:id,package_header_id,pax_change'
        ])

        ->where('product_id', $product_id)
        ->active()
        ->orderBy('package_name')
        ->get();

        // dd($packages);
        $dataPackages = [];
        foreach ($packages as $package) {
            $packagePrice = $package->priceTypes->firstWhere('price_type_name', 'Public Price')->pivot->price;
            $packageItems = $package->items->map(function ($item) {
                return [
                    'item_icon' => $item->item_icon,
                    'item_name' => $item->item_name
                ];
            });

            $dataPackages[] = [
                'id' => $package->id,
                'package_name' => $package->package_name,
                'package_price' => $packagePrice,
                'package_uom' => optional($package->packageDetail->uom)->measurement_name,
                'product_image_path' => $package->product->productImages->firstWhere('is_default', 1)?->file_path,
                'package_pax' => $package->packageInventories->where('package_header_id', $package->id)->sum('pax_change'),
                'package_items' => $packageItems
            ];
        }

        $response = [
            'status' => 'success',
            'status_code' => 200,
            'message' => "The package details from $product->product_name product have been successfully received.",
            'data' => [
                'packages' => $dataPackages
            ]
        ];

        return response()->json($response, 200);
    }
}