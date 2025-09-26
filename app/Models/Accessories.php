<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Accessories extends Model implements HasMedia
{
    use InteractsWithMedia;

    public static function boot()
    {

        parent::boot();

        //Creating hashids for each accessory
        static::created(function ($accessory) {
            $salt = config('key') . config('name');
            $hashids = new Hashids($salt, 12);

            $accessory->hashid = $hashids->encode($accessory->id);
            $accessory->save();
        });
    }

    public function cartItems()
    {
        return $this->morphMany(CartItems::class, 'product');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection("accessories_images")
            ->useDisk("public");
    }
}
