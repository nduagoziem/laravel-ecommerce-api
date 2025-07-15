<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PhoneResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */


    public function toArray(Request $request): array
    {
        return $this->collection->transform(fn($phone): array => [
            'hashid' => $request->input('hashid', $phone->hashid),
            'name' => $request->input('name', $phone->name),
            'price' => $request->input('price', $phone->price),
            'brand' => $request->input('brand', $phone->brand),
            'tags' => $request->input('tags', $phone->tags),
            'stock' => $request->input('stock', $phone->stock),
            'description' => $request->input('description', $phone->description),
            'media' => $phone->media->map(fn($m) => $m->getUrl())
        ])->toArray();
    }
}
