<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\TabletController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\AccessoriesController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/phones', [PhoneController::class, 'get'])->name('phones.get');
Route::get('/pcs', [ComputerController::class, 'get'])->name('pcs.get');
Route::get('/tablets', [TabletController::class, 'get'])->name('tablets.get');
Route::get('/accessories', [AccessoriesController::class, 'get'])->name('accessories.get');