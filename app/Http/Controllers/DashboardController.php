<?php

namespace App\Http\Controllers;

use App\Models\Master\Event;
use App\Models\Master\Product;
use App\Models\Master\Venue;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard',[
            'total_venues' => Venue::count(),
            'total_products' => Product::count(),
            'total_news' => Event::count(),
        ]);
    }
}
