<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class ProductsController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('admin/products/ProductsPanel');
    }

    public function show(): \Inertia\Response
    {
        return Inertia::render('admin/products/Show');
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('admin/products/Create');
    }

    public function edit(): \Inertia\Response
    {
        return Inertia::render('admin/products/Update');
    }

}
