<?php

namespace App\Http\Resources\CMS;

use Crypt;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyProfileResource extends JsonResource
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
            'company_email' => $this->company_email,
            'company_address' => $this->company_address,
            'company_iframe_maps_url' => $this->company_iframe_maps_url,
            'company_phone_number' => $this->company_phone_number,
        ];
    }
}
