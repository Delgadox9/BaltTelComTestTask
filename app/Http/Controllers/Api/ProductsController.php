<?php

namespace App\Http\Controllers\Api;

use App\Actions\API\Product\CreateProductAction;
use App\Actions\API\Product\DeleteProductAction;
use App\Actions\API\Product\GetProductsAction;
use App\Actions\API\Product\ShowProductAction;
use App\Actions\API\Product\UpdateProductAction;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\DeleteProductRequest;
use App\Http\Requests\Product\IndexProductRequest;
use App\Http\Requests\Product\ShowProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;

class ProductsController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexProductRequest $request, GetProductsAction $action): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $paginator = $action->execute($request->getDTO());

        return ProductResource::collection($paginator);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @throws \Throwable
     */
    public function create(CreateProductRequest $request, CreateProductAction $action): \Illuminate\Http\JsonResponse
    {
        $product = $action->execute($request->getDTO());

        return (new ProductResource($product))->response();
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowProductRequest $request, ShowProductAction $action): \Illuminate\Http\JsonResponse
    {
        $product = $action->execute($request->getDTO());

        return (new ProductResource($product))->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws \Throwable
     */
    public function update(UpdateProductRequest $request, UpdateProductAction $action): \Illuminate\Http\JsonResponse
    {
        $product = $action->execute($request->getDTO());

        return (new ProductResource($product))->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws \Throwable
     */
    public function delete(DeleteProductRequest $request, DeleteProductAction $action): \Illuminate\Http\JsonResponse
    {
        return $action->execute($request->getDTO());
    }
}
