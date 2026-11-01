<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Admin\Http\Controllers\AdminController;

Route::prefix('api/v1/admin')->middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('', [AdminController::class, 'index']);
    Route::post('/{id}/roles', [AdminController::class, 'roles']);
    Route::patch('/{id}/status', [AdminController::class, 'status']);
    Route::delete('/{id}/delete', [AdminController::class, 'delete']);
    Route::post('/search', [AdminController::class, 'search']);
    Route::get('/authors', [AdminController::class, 'authors']);
    Route::post('/create', [AdminController::class, 'create']);
    Route::patch('{id}/update', [AdminController::class, 'update']);
    Route::delete('{id}/delete/categories', [AdminController::class, 'deleteCategories']);
});