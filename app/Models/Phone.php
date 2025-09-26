<?php

namespace App\Models;

use Hashids\Hashids;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Phone extends Model implements HasMedia
{

    use InteractsWithMedia;

    public static function boot()
    {

        parent::boot();

        //Creating hashids for each phone
        static::created(function ($phone) {
            $salt = config('name') . config('key');
            $hashids = new Hashids($salt, 12);

            $phone->hashid = $hashids->encode($phone->id);
            $phone->save();
        });
    }

    public function cartItems()
    {
        return $this->morphMany(CartItems::class, 'product');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection("phone_images")
            ->useDisk("public");
    }
}
