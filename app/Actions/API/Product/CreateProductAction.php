<?php

namespace App\Actions\API\Product;

use app\DTO\Products\CreateProductDTO;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

final class CreateProductAction
{
    /**
     * @throws \Throwable
     */
    public function execute(CreateProductDTO $dto): Product|array
    {
        return DB::transaction(function () use ($dto) {
            return Product::create([
                'name' => $dto->name,
                'description' => $dto->description,
                'price' => $dto->price,
                'category_id' => $dto->categoryId,
            ]);
        });
    }
}
