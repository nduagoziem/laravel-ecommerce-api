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
            'id' => $phone->id,
            'hashid' => $phone->hashid,
            'name' => $phone->name,
            'price' => $phone->price,
            'brand' => $phone->brand,
            'tags' => $phone->tags,
            'stock' => $phone->stock,
            'description' => $phone->description,
            'media' => $phone->media->map(fn($m) => [
                'id' => $m->uuid,
                'url' => $m->getUrl(),
            ])
        ])->toArray();
    }
}
