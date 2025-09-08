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
            'id' => $computer->id,
            'hashid' => $computer->hashid,
            'name' => $computer->name,
            'price' => $computer->price,
            'brand' => $computer->brand,
            'tags' => $computer->tags,
            'stock' => $computer->stock,
            'description' => $computer->description,
            'media' => $computer->media->map(fn($m) => [
                'id' => $m->uuid,
                'url' => $m->getUrl(),
            ])
        ])->toArray();
    }
}
