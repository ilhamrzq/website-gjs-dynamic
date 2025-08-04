<?php

namespace App\Http\Resources\Video;

use Crypt;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $langId = $request->query('lang_id', 1);

        $videoTitleField = $langId == 1 ? 'video_title_id' : 'video_title_en';

        return [
            'id' => Crypt::encrypt($this->id),
            'video_title' => $this->{$videoTitleField},
            'video_url' => $this->file_path,
        ];
    }
}
