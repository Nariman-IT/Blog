<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Post\Http\Controllers\PostController;

Route::prefix('api/v1/post')->middleware(['auth:sanctum', 'author'])->group(function () {
    Route::get('', [PostController::class, 'index']);    
    Route::post('', [PostController::class, 'store']);
    Route::patch('/{id}', [PostController::class, 'update']);
    Route::delete('/{id}', [PostController::class, 'delete']);
});