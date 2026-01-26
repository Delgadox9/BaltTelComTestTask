<?php

namespace App\Actions\API\Product;

use app\DTO\Products\UpdateProductDTO;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

final class UpdateProductAction
{
    /**
     * @throws \Throwable
     */
    public function execute(UpdateProductDTO $dto): Product|array
    {
        return DB::transaction(function () use ($dto) {
            $product = Product::find($dto->id);

            $product->name = $dto->name ?? $product->name;
            $product->description = $dto->description ?? $product->description;
            $product->price = $dto->price ?? $product->price;
            $product->category_id = $dto->categoryId ?? $product->category_id;
            $product->update();

            return $product;
        });
    }
}
