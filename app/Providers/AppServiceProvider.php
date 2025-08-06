<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Phone;
use App\Models\Tablets;
use App\Models\Computers;
use App\Models\Accessories;
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
        User::unguard();
        Phone::unguard();
        Computers::unguard();
        Tablets::unguard();
        Accessories::unguard();
    }
}
