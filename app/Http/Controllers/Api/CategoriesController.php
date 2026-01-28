<?php

namespace App\Http\Controllers\Api;

use App\Actions\API\Category\GetCategoryAction;
use App\Http\Controllers\Controller;
use app\Http\Requests\Category\IndexCategoryRequest;
use App\Http\Resources\CategoryResource;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexCategoryRequest $request, GetCategoryAction $action): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $categories = $action->execute($request);

        return CategoryResource::collection($categories);
    }
}
