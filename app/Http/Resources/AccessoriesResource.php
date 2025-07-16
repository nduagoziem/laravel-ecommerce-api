<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AccessoriesResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->transform(fn($accessories): array => [
            'hashid' => $accessories->hashid,
            'name' => $accessories->name,
            'price' => $accessories->price,
            'tags' => $accessories->tags,
            'stock' => $accessories->stock,
            'description' => $accessories->description,
            'media' => $accessories->media->map(fn($m) => $m->getUrl())
        ])->toArray();
    }
}
