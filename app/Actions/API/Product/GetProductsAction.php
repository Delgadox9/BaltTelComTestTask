<?php

namespace App\Actions\API\Product;

use app\DTO\Products\IndexProductDTO;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

final class GetProductsAction
{
    public function execute(IndexProductDTO $dto): LengthAwarePaginator
    {
        return Product::query()->paginate(
            perPage: 10,
            page: $dto->page
        );
    }
}
