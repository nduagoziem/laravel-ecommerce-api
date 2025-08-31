<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomerController;
use App\Http\Controllers\TestController;

Route::post("/customer/register", [CustomerController::class, "register"])->name("customer.register")->middleware("guest:customer");

Route::post("/customer/login", [CustomerController::class, "login"])->name("customer.login")->middleware("guest:customer");

Route::post("/customer/logout", [CustomerController::class, "logout"])->name("customer.logout")->middleware("auth:customer");

Route::get('/customer', [CustomerController::class, "getLoggedInCustomer"])->middleware('auth:customer');

// Route::get('/customer', [CustomerController::class, "geCustomerDetails"])->middleware('auth:customer');

Route::get('/test', [TestController::class, "myMax"])->name("test");
