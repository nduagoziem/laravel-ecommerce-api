<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Computers extends Model
{
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection("computer_images")
            ->useDisk("public");
    }
}
