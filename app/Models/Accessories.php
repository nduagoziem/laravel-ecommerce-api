<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accessories extends Model
{
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection("accessories_images")
            ->useDisk("public");
    }
}
