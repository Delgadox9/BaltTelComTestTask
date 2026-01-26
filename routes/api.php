<?php

use App\Http\Controllers\Api\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('products', ProductsController::class)->only(['index', 'show', 'update']);
Route::delete('products/{product}', [ProductsController::class, 'delete'])->name('products.delete');
Route::post('products', [ProductsController::class, 'create'])->name('products.create');
