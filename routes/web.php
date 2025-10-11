<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\CustomerController;

Route::middleware('auth:customer')
    ->prefix("customer")
    ->group(function () {
        Route::post("/register", [CustomerController::class, "register"])->name("customer.register");

        Route::post("/login", [CustomerController::class, "login"])->name("customer.login");
        Route::post("/logout", [CustomerController::class, "logout"])->name("customer.logout");

        Route::get('', [CustomerController::class, "getLoggedInCustomer"])->name("customer"); // Still works if you use /customer
    });

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
