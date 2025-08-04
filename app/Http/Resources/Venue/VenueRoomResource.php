<?php

namespace App\Http\Resources\Venue;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class VenueRoomResource extends JsonResource
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
            'room_name' => $this->room_name,
            'room_description' => $this->room_description,
            'room_minimum_charge' => $this->room_minimum_charge, // GANTI INI
            'room_image' => $this->whenLoaded('selectedImage', function () {
                return $this->selectedImage
                    ? [
                        'image_url' => $this->selectedImage->file_path,
                    ]
                    : null;
            }),
        ];
    }
}
