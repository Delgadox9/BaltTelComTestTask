<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [AuthController::class, 'login'])->name('api.login');
// Рут выключен поскольку не требуется по ТЗ
// Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('products', [ProductsController::class, 'index'])->name('api.products.index');
Route::get('products/{product}', [ProductsController::class, 'show'])->name('api.products.show');
Route::apiResource('categories', CategoriesController::class)->only(['index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('api.logout');

    Route::apiResource('products', ProductsController::class)->only(['update']);
    Route::delete('products/{product}', [ProductsController::class, 'delete'])->name('api.products.delete');
    Route::post('products', [ProductsController::class, 'create'])->name('api.products.create');
});

