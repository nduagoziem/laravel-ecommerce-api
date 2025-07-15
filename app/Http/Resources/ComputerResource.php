<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ComputerResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->transform(fn($computer): array => [
            'hashid' => $request->input('hashid', $computer->hashid),
            'name' => $request->input('name', $computer->name),
            'price' => $request->input('price', $computer->price),
            'brand' => $request->input('brand', $computer->brand),
            'tags' => $request->input('tags', $computer->tags),
            'stock' => $request->input('stock', $computer->stock),
            'description' => $request->input('description', $computer->description),
            'media' => $computer->media->map(fn($m) => $m->getUrl())
        ])->toArray();
    }
}
