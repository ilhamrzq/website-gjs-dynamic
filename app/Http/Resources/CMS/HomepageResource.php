<?php

namespace App\Http\Resources\CMS;

use Crypt;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomepageResource extends JsonResource
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
            'hero_title' => $this->hero_title,
            'hero_description' => $this->hero_description,
            'feature_left_title' => $this->feature_left_title,
            'feature_left_description' => $this->feature_left_description,
            'feature_center_title' => $this->feature_center_title,
            'feature_center_description' => $this->feature_center_description,
            'feature_right_title' => $this->feature_right_title,
            'feature_right_description' => $this->feature_right_description,
            'video_url' => $this->video_path,
            'thumbnail_image' => $this->getThumbnailImage() ? [
                'image_url' => $this->getThumbnailImage()->file_path
            ] : null,
        ];
    }
}

// 'thumbnail_image' => $this->whenLoaded('selectedImage', function () {
//     return $this->selectedImage
//         ? [
//             'image_url' => $this->selectedImage->file_path,
//         ]
//         : null;
// }),