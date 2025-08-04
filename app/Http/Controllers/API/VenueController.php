<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Venue\VenueCollection;
use App\Models\Master\Venue;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VenueController extends Controller
{
    public function index()
    {
        $venues = Venue::with('selectedImage')
            ->get();
        
        return response()->json([
            'data' => [
                'venues' => new VenueCollection($venues),
            ],
            'message' => 'Venues retrieved successfully',
        ]);
    }  
}
