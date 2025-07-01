<?php

namespace App\Observers;

use App\Models\Accessories;
use Illuminate\Support\Facades\Storage;

class AccessoriesObserver
{
    /**
     * Handle the Accessories "created" event.
     */
    public function created(Accessories $accessories): void
    {
        //
    }

    /**
     * Handle the Accessories "updated" event.
     */
    public function updated(Accessories $accessories): void
    {
        //
    }

    /**
     * Handle the Accessories "deleted" event.
     */
    public function deleted(Accessories $accessories): void
    {
        if (!is_null($accessories->accessories_images)) {
            Storage::disk('public')->delete($accessories->accessories_images);
        }
    }

    /**
     * Handle the Accessories "restored" event.
     */
    public function restored(Accessories $accessories): void
    {
        //
    }

    /**
     * Handle the Accessories "force deleted" event.
     */
    public function forceDeleted(Accessories $accessories): void
    {
        //
    }
}
