<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\{CartService, OrderService};
use App\Models\{User, Phone, Tablets, Computers, Accessories};
use App\Interfaces\{CartServiceInterface, OrderServiceInterface};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CartServiceInterface::class, CartService::class);
        $this->app->singleton(OrderServiceInterface::class, OrderService::class);
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
