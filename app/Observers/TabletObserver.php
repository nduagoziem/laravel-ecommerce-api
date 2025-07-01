<?php

namespace App\Observers;

use App\Models\Tablets;
use Illuminate\Support\Facades\Storage;

class TabletObserver
{
    /**
     * Handle the Tablets "created" event.
     */
    public function created(Tablets $tablets): void
    {
        //
    }

    /**
     * Handle the Tablets "updated" event.
     */
    public function updated(Tablets $tablets): void
    {
        //
    }

    /**
     * Handle the Tablets "deleted" event.
     */
    public function deleted(Tablets $tablets): void
    {
        if (!is_null($tablets->tablet_images)) {
            Storage::disk('public')->delete($tablets->tablet_images);
        }
    }

    /**
     * Handle the Tablets "restored" event.
     */
    public function restored(Tablets $tablets): void
    {
        //
    }

    /**
     * Handle the Tablets "force deleted" event.
     */
    public function forceDeleted(Tablets $tablets): void
    {
        //
    }
}
