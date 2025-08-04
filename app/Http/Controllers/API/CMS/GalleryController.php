<?php

namespace App\Http\Controllers\API\CMS;

use App\Http\Controllers\Controller;
use App\Http\Resources\Gallery\GalleryCollection;
use App\Models\CMS\GalleryCategory;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request) 
    {
        $lang_id = $request->query('lang_id', 1);

        $categoryName = '';
        $categorySlug = '';

        $lang_id == 1 ?
            $categoryName = 'category_name_id' :
            $categoryName = 'category_name_en';
        
        $lang_id == 1 ?
            $categorySlug = 'category_slug_id' :
            $categorySlug = 'category_slug_en';

        $categories = GalleryCategory::with(['gallery', 'previewImage'])
                    ->select(
                        'id',
                        $categoryName,
                        $categorySlug,
                        'updated_at'
                    )
                    ->active()
                    ->get();
    
        return response()->json([
            'data' => new GalleryCollection($categories),
            'message' => "Gallery images retrieved successfully",
        ]);
    }
}
