<?php

namespace App\Http\Resources\CMS;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class SponsorshipResource extends JsonResource
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
            'sponsor_type_name' => $this->sponsor_type_name,
            'sponsor_images' => $this->whenLoaded('sponsorshipImages', function () {
                return $this->sponsorshipImages->map(function ($image) {
                    return [
                        'image_url' => $image->file_path,
                    ];
                });
            }),
        ];
    }
}
