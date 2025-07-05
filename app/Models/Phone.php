<?php

namespace App\Models;

use Hashids\Hashids;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection("phone_images")
            ->useDisk("public");
    }
}
