<?php

namespace App\Http\Resources\Venue;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class VenueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => Crypt::encrypt($this->id),
            'venue_name' => $this->venue_name,
            'venue_slug' => $this->venue_slug,
            'venue_address' => $this->venue_address,
            'venue_price' => $this->venue_price,
            'venue_opening_time' => $this->venue_opening_time,
            'venue_closing_time' => $this->venue_closing_time,
            'venue_image' => $this->whenLoaded('selectedImage', function () {
                return $this->selectedImage
                    ? [
                        'image_url' => $this->selectedImage->file_path,
                    ]
                    : null;
            }),
        ];
    }
}
