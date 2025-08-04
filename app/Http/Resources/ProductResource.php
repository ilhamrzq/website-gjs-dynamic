<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class ProductResource extends JsonResource
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
            'product_name' => $this->product_name,
            'product_description' => $this->product_description,
            'product_price' => $this->product_price,
            'product_stock' => $this->product_stock,
            'product_slug' => $this->product_slug,
            'product_image' => $this->whenLoaded('productItemImages', function () {
                return $this->productItemImages->map(function ($image) {
                    return [
                        'image_id' => Crypt::encrypt($image->id),
                        'image_name' => $image->file_name,
                        'image_url' => $image->file_path,
                    ];
                });
            }),
            'product_category' => $this->whenLoaded('category', function () {
                return [
                    'category_id' => Crypt::encrypt($this->category->id),
                    'product_category_name' => $this->category->product_category_name,
                ];
            }),
        ];
    }
}
