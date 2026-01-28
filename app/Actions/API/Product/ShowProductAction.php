<?php

namespace App\Actions\API\Product;

use App\DTO\Product\ShowProductDTO;
use App\Models\Product;

final class ShowProductAction
{
    public function execute(ShowProductDTO $dto): Product
    {
        return Product::where('id', '=', $dto->id)->first();
    }
}
