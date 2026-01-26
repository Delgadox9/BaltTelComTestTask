<?php

namespace App\Actions\API\Category;

use App\DTO\Category\IndexCategoryDTO;
use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;

final class GetCategoryAction
{
    public function execute(IndexCategoryDTO $dto): LengthAwarePaginator
    {
        return Category::query()->paginate(
            perPage: 10,
            page: $dto->page
        );
    }
}
