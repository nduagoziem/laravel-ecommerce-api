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
            'hashid' => $request->input('hashid', $tablet->hashid),
            'name' => $request->input('name', $tablet->name),
            'price' => $request->input('price', $tablet->price),
            'brand' => $request->input('brand', $tablet->brand),
            'tags' => $request->input('tags', $tablet->tags),
            'stock' => $request->input('stock', $tablet->stock),
            'description' => $request->input('description', $tablet->description),
            'media' => $tablet->media->map(fn($m) => $m->getUrl())
        ])->toArray();
    }
}
