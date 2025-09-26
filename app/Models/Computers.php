<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Computers extends Model implements HasMedia
{
    use InteractsWithMedia;
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

     public function cartItems() {
        return $this->morphMany(CartItems::class, 'product');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection("computer_images")
            ->useDisk("public");
    }
}
