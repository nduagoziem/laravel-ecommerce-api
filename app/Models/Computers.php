<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Model;

class Computers extends Model
{
    public static function boot()
    {

        parent::boot();

        //Creating hashids for each computer
        static::created(function ($computer) {
            $salt = config('key') . config('url');
            $hashids = new Hashids($salt, 12);

            $computer->hashid = $hashids->encode($computer->id);
            $computer->save();
        });
    }


    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection("computer_images")
            ->useDisk("public");
    }
}
