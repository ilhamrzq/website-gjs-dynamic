<?php

namespace App\Http\Resources\Event;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class EventResource extends JsonResource
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
            'event_title' => $this->event_title,
            'venue_name' => optional($this->venue)->venue_name,
            'event_slug' => $this->event_slug,
            'event_description' => $this->event_description,
            'event_start_date' => $this->event_start_date,
            'event_end_date' => $this->event_end_date,
            'event_status' => $this->event_status,
            'event_image' => $this->whenLoaded('selectedImage', function () {
                return $this->selectedImage ? [
                    'image_url' => $this->selectedImage->file_path,
                ] : null;
            }),
        ];
    }
}
