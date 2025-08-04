<?php

namespace App\Http\Resources\Gallery;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class GalleryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        $langId = $request->query('lang_id', 1);

        $categoryNameField = $langId == 1 ? 'category_name_id' : 'category_name_en';
        $categorySlugField = $langId == 1 ? 'category_slug_id' : 'category_slug_en';

        // 1️⃣ Try to get default image (is_default = 1)
        $defaultImage = $this->gallery()
            ->active()
            ->where('is_default', 1)
            ->select('id', 'file_path')
            ->first();

        // 2️⃣ If no default, fallback to previewImage (if loaded)
        if (!$defaultImage && $this->relationLoaded('previewImage')) {
            $defaultImage = $this->previewImage;
        }

        // 3️⃣ If still no image, fallback to first active image in gallery (ordered by ID)
        if (!$defaultImage) {
            $defaultImage = $this->gallery()
                ->active()
                ->orderBy('id')
                ->select('id', 'file_path')
                ->first();
        }

        return [
            'id' => Crypt::encrypt($this->id),
            'category_name' => $this->{$categoryNameField},
            'category_slug' => $this->{$categorySlugField},
            'updated_at' => $this->updated_at,
            'image' => $defaultImage ? [
                'image_url' => $defaultImage->file_path,
            ] : null,
        ];
    }
}
