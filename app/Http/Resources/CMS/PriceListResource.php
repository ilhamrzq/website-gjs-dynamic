<?php

namespace App\Http\Resources\CMS;

use Crypt;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PriceListResource extends JsonResource
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
            'price_name' => $this->price_name,
            'price_normal' => $this->price_normal,
            'price_promo' => $this->price_promo
        ];
    }
}
