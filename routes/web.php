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

Route::get('/', [\app\Http\Controllers\Frontend\ProductsController::class, 'index'])
    ->name('home');

Route::get('/products/{product}', [\app\Http\Controllers\Frontend\ProductsController::class, 'show'])
    ->name('products.show');
