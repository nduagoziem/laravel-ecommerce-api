<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TabletResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->transform(fn($tablet): array => [
            'hashid' => $tablet->hashid,
            'name' => $tablet->name,
            'price' => $tablet->price,
            'brand' => $tablet->brand,
            'tags' => $tablet->tags,
            'stock' => $tablet->stock,
            'description' => $tablet->description,
            'media' => $tablet->media->map(fn($m) => $m->getUrl())
        ])->toArray();
    }
}
