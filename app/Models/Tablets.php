<?php

namespace App\Models;

use Hashids\Hashids;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Tablets extends Model implements HasMedia
{
    use InteractsWithMedia;
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

     public function cartItems() {
        return $this->morphMany(CartItems::class, 'product');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection("tablet_images")
            ->useDisk("public");
    }
}
