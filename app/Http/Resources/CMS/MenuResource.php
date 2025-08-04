<?php

namespace App\Http\Resources\CMS;

use Crypt;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
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
            'lang_id' => $this->lang_id,
            'category_name' => $this->category_name,
            'menu_name' => $this->menu_name,
            'menu_path' => $this->menu_path,
            'is_menu' => $this->is_menu,
        ];
    }
}
