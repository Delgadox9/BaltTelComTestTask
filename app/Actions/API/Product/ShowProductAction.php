<?php

namespace App\Actions\API\Product;

use app\DTO\Products\ShowProductDTO;
use App\Models\Product;

final class ShowProductAction
{
    public function execute(ShowProductDTO $dto): Product
    {
        return Product::find($dto->id);
    }
}
