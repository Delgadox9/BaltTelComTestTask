<?php

namespace app\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class ProductsController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('products/Index');
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('products/Index');
    }

    public function show(): \Inertia\Response
    {
        return Inertia::render('products/Show');
    }

    public function update(): \Inertia\Response
    {
        return Inertia::render('products/Index');
    }

    public function delete(): \Inertia\Response
    {
        return Inertia::render('products/Index');
    }
}
