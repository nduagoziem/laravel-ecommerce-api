<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\CustomerController;

Route::post("/customer/register", [CustomerController::class, "register"])->name("customer.register")->middleware("guest:customer");

Route::post("/customer/login", [CustomerController::class, "login"])->name("customer.login")->middleware("guest:customer");

Route::post("/customer/logout", [CustomerController::class, "logout"])->name("customer.logout")->middleware("auth:customer");

Route::get('/customer', [CustomerController::class, "getLoggedInCustomer"])->middleware('auth:customer');

Route::middleware('auth:customer')
    ->prefix("cart")
    ->group(function () {
        Route::get('/show',  [CartController::class, "showCart"])->name("cart.show");
        Route::post('/add',  [CartController::class, "addToCart"])->name("cart.add");
        Route::patch('/update',  [CartController::class, "updateCart"])->name("cart.update");
        Route::post('/remove',  [CartController::class, "removeFromCart"])->name("cart.remove");
        Route::post('/clear',  [CartController::class, "clear"])->name("cart.clear");
        Route::get('/total',  [CartController::class, "recalculate"])->name("cart.recalculate");
    });

Route::post("/customer/order", [OrderController::class, "orderAndPay"])->name("customer.order")->middleware("auth:customer");

Route::get('/run', function () {
    Artisan::call('migrate', ['--force' => true]);
    return 'Migrations completed!';
});
