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
            'hashid' => $request->input('hashid', $accessories->hashid),
            'name' => $request->input('name', $accessories->name),
            'price' => $request->input('price', $accessories->price),
            'tags' => $request->input('tags', $accessories->tags),
            'stock' => $request->input('stock', $accessories->stock),
            'description' => $request->input('description', $accessories->description),
            'media' => $accessories->media->map(fn($m) => $m->getUrl())
        ])->toArray();
    }
}
