<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class ProductsController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('products/Index');
    }

    public function show(): \Inertia\Response
    {
        return Inertia::render('products/Show');
    }
}
