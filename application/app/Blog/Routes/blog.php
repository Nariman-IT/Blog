<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Blog\Http\Controllers\BlogController;

Route::prefix('api/v1/post')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/main', [BlogController::class, 'main']);
    Route::get('/{id}/index', [BlogController::class, 'index']);
    Route::get('/{id}/show', [BlogController::class, 'show']);
    Route::post('/{id}/comment', [BlogController::class, 'comment']);
    Route::delete('/{id}/comment/{commentId}', [BlogController::class, 'delete']);
    Route::get('{categories}/categories', [BlogController::class, 'categories']);
});