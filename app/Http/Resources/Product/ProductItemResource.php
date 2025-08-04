<?php

namespace App\Http\Resources\Product;

use Crypt;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductItemResource extends JsonResource
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
            'product_category' => $this->category->product_category_name,
            'product_description' => $this->product_description,
            'product_stock' => $this->product_stock,
            'product_slug' => $this->product_slug,
            'product_prices' => $this->relPrice->map(fn($p) => [
                'price_type_name' => $p->priceType->price_type_name,
                'price' => $p->price,
            ]),

            'product_discounts' => $this->relDiscount->map(fn($d) => [
                'discount_type_name' => $d->discountType->discount_type_name,
                'discount' => $d->discount,
            ]),
            'product_images' => $this->whenLoaded('productItemImages', function () {
                return $this->productItemImages->map(function ($image) {
                    return [
                        'image_url' => $image->file_path,
                    ];
                });
            }),
        ];
    }
}
