<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Model;

class Tablets extends Model
{

    public static function boot()
    {

        parent::boot();

        //Creating hashids for each tablet
        static::created(function ($tablet) {
            $salt = config('name') . config('url');
            $hashids = new Hashids($salt, 12);

            $tablet->hashid = $hashids->encode($tablet->id);
            $tablet->save();
        });
    }


    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection("tablet_images")
            ->useDisk("public");
    }
}
