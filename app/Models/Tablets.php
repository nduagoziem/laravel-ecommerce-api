<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tablets extends Model
{
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection("tablet_images")
            ->useDisk("public");
    }
}
