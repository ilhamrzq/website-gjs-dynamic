<?php

namespace App\Http\Resources\CMS;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MenuCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'standalone' => MenuResource::collection($this->collection->filter(fn($m) => $m->category_name === null)),
            'grouped' => $this->collection->whereNotNull('category_name')
                ->groupBy('category_name')
                ->map(fn($items) => MenuResource::collection($items)),
            // 'menu' => MenuResource::collection($this->collection),
        ];
    }
}
