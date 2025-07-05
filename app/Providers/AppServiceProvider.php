<?php

namespace App\Providers;

use App\Models\Accessories;
use App\Models\Phone;
use App\Models\Tablets;
use App\Models\Computers;
use App\Observers\AccessoriesObserver;
use App\Observers\PhoneObserver;
use App\Observers\TabletObserver;
use App\Observers\ComputerObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
    }
}
