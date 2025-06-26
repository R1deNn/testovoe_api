<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Session\Middleware\StartSession;

Route::get('products', [\App\Http\Controllers\Api\ProductController::class, 'index']);
Route::get('products/{id}', [\App\Http\Controllers\Api\ProductController::class, 'show']);

Route::post('register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');

Route::middleware([StartSession::class])->group(function () {
    Route::get('cart', [\App\Http\Controllers\Api\CartController::class, 'index']);
    Route::post('cart', [\App\Http\Controllers\Api\CartController::class, 'store']);
    Route::put('cart/{product_id}', [\App\Http\Controllers\Api\CartController::class, 'update']);
    Route::delete('cart/{product_id}', [\App\Http\Controllers\Api\CartController::class, 'destroy']);
});
