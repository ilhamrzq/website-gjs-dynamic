<?php

namespace App\Http\Resources\Event;

use App\Models\Master\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EventCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return EventResource::collection($this->collection)->resolve();
    }
}
