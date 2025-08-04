<?php

namespace App\Http\Controllers\API\CMS;

use App\Http\Controllers\Controller;
use App\Http\Resources\CMS\MenuCollection;
use App\Http\Resources\CMS\MenuResource;
use App\Models\CMS\Menu;
use Illuminate\Http\Request;

class CMSMenuController extends Controller
{
    public function index(Request $request)
    {
        $menus = Menu::where('is_menu', true)
            ->where('lang_id', $request->query('lang_id', 1))
            ->orderBy('created_at', 'asc')
            ->get();

        $standalone = $menus->filter(fn($menu) => $menu->category_name === null);
        $grouped = $menus->whereNotNull('category_name')
                        ->groupBy('category_name');

        return response()->json([
            'data' => [
                'standalone' => MenuResource::collection($standalone),
                'grouped' => $grouped->map(fn($items) => MenuResource::collection($items)),
            ],
            'message' => $menus->isEmpty() ? 'No menus found' : 'CMS menus content retrieved successfully',
        ]);
    }
    // public function index(Request $request)
    // {
    //     $menus = Menu::where('is_menu', true)
    //                     ->where('lang_id', $request->query('lang_id', 1))
    //                     ->orderBy('created_at', 'asc')
    //                     ->get();

    //     return response()->json([
    //         'data' => new MenuCollection($menus),
    //         'message' => $menus->isEmpty() ? 'No menus found' : 'CMS menus content retrieved successfully',
    //     ]);
    // }
}