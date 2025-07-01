<?php

namespace App\Observers;

use App\Models\Phone;
use Illuminate\Support\Facades\Storage;

class PhoneObserver
{
    /**
     * Handle the Phone "created" event.
     */
    public function created(Phone $phone): void
    {
        //
    }

    /**
     * Handle the Phone "updated" event.
     */
    public function updated(Phone $phone): void
    {

    }

    /**
     * Handle the Phone "deleted" event.
     */
    public function deleted(Phone $phone): void
    {
        if (!is_null($phone->phone_images)) {
            Storage::disk('public')->delete($phone->phone_images);
        }
    }

    /**
     * Handle the Phone "restored" event.
     */
    public function restored(Phone $phone): void
    {
        //
    }

    /**
     * Handle the Phone "force deleted" event.
     */
    public function forceDeleted(Phone $phone): void
    {
        //
    }
}
