<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrdersController;


Route::prefix('v1/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});


Route::middleware('auth:api')->group(function () {
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrdersController::class, 'list']);
        Route::post('/', [OrdersController::class, 'create']);
        Route::post('/{id}/advance', [OrdersController::class, 'advance']);
        Route::get('/{id}', [OrdersController::class, 'get']);
    });
});
