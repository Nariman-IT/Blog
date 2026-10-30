<?php

declare(strict_types=1);

use App\Auth\Http\Controllers\AuthController;
use App\Auth\Http\Controllers\ForgotPasswordController;
use App\Auth\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/v1/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:3,5');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'send'])->middleware('throttle:3,5');;
    Route::post('/reset-password',  [ResetPasswordController::class,  'reset'])->middleware('throttle:5,1');;
});