<?php

namespace App\Actions\API\Product;

use App\DTO\Product\IndexProductDTO;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

final class GetProductsAction
{
    public function execute(IndexProductDTO $dto): array|\Illuminate\Pagination\LengthAwarePaginator
    {
        $query = Product::query()->with('category')->when(
            $dto->search, function (Builder $query, int $dto) {
                $query->where('category_id', '=', $dto);
            }
        );

        return $query->paginate(
            perPage: 10,
            page: $dto->page
        );
    }
}
