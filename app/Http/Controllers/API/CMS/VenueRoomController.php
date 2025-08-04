<?php

namespace App\Http\Controllers\API\CMS;

use App\Http\Controllers\Controller;
use App\Http\Resources\Venue\VenueCollection;
use App\Http\Resources\Venue\VenueRoomCollection;
use App\Models\Master\VenueRoom;
use Illuminate\Http\Request;

class VenueRoomController extends Controller
{
    public function index()
    {
        $venueRooms = VenueRoom::with(['venue', 'selectedImage'])
                            ->get();

        if ($venueRooms->isEmpty()) {
            return response()->json([
                'data' => [],
                'message' => 'No venue rooms found',
            ], 404);
        }

        return response()->json([
            'data' => new VenueRoomCollection($venueRooms),
            'message' => 'Venue rooms retrieved successfully',
        ]);
    }
}
