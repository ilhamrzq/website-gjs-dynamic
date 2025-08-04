<?php

namespace App\Http\Resources\CMS;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class SocialMediaResource extends JsonResource
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
            'socmed_name' => $this->socmed_name,
            'socmed_icon' => $this->socmed_icon,
            'socmed_url' => $this->socmed_url,
            'socmed_username' => $this->socmed_username,
        ];
    }
}
