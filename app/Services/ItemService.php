<?php

namespace App\Services;

use App\Models\Master\Item;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ItemService
{
    protected string $uploadPath = 'assets/icons/';


    // arti ?, $icon bisa berupa instance dari UploadedFile atau null
    public function uploadItemIcon(?UploadedFile $icon): ?string
    {
        if (!$icon || !$icon->isValid()) {
            return null;
        }

        $basePath = public_path($this->uploadPath);
        if (!File::exists($basePath)) {
            File::makeDirectory($basePath, 0755, true, true);
        }

        $iconName = time() . '_' . uniqid() . '.' . $icon->getClientOriginalExtension();
        $icon->move($basePath, $iconName);

        return asset($this->uploadPath . $iconName);
    }

    public function saveItemPrices(array $priceData, Item $item)
    {
        $prices = [];
        foreach ($priceData as $key => $value) {
            $parts = explode('_', $key, 2); // cuman butuh 2 bagian, 1_Public_Price;
            $priceTypeId = $parts[0];
            $priceTypeName = $parts[1];

            $prices[$priceTypeId] = ['price' => $value];
        }

        // mapping item id dengan price
        $item->priceTypes()->sync($prices);
        return $prices;
    }
}