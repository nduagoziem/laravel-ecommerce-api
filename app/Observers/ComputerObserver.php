<?php

namespace App\Observers;

use App\Models\Computers;
use Illuminate\Support\Facades\Storage;

class ComputerObserver
{
    /**
     * Handle the Computers "created" event.
     */
    public function created(Computers $computers): void
    {
        //
    }

    /**
     * Handle the Computers "updated" event.
     */
    public function updated(Computers $computers): void
    {
        //
    }

    /**
     * Handle the Computers "deleted" event.
     */
    public function deleted(Computers $computers): void
    {
        if (!is_null($computers->computer_images)) {
            Storage::disk('public')->delete($computers->computer_images);
        }
    }

    /**
     * Handle the Computers "restored" event.
     */
    public function restored(Computers $computers): void
    {
        //
    }

    /**
     * Handle the Computers "force deleted" event.
     */
    public function forceDeleted(Computers $computers): void
    {
        //
    }
}
