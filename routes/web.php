<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

// Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canRegister' => Features::enabled(Features::registration()),
//    ]);
// })->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';

Route::get('/', [\App\Http\Controllers\Frontend\ProductsController::class, 'index'])
    ->name('home');
Route::get('/products/{product}', [\App\Http\Controllers\Frontend\ProductsController::class, 'show'])
    ->name('products.show');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('admin/products', [\App\Http\Controllers\Admin\ProductsController::class, 'index'])
        ->name('admin.products.index');

    Route::get('admin/products/create', [\App\Http\Controllers\Admin\ProductsController::class, 'create'])
        ->name('admin.products.create');

    Route::get('admin/products/{product}/edit', [\App\Http\Controllers\Admin\ProductsController::class, 'edit'])
        ->name('admin.products.edit');

    Route::get('admin/products/{product}', [\App\Http\Controllers\Admin\ProductsController::class, 'show'])
        ->name('admin.products.show');
});
