<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});


