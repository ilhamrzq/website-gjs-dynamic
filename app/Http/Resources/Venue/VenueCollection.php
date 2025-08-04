<?php

namespace App\Http\Resources\Venue;

use App\Models\Master\Venue;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VenueCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return VenueResource::collection($this->collection)->resolve();
    }
}

// return VenueResource::collection(Venue::with('venueImages')->get())->resolve();