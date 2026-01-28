<?php

namespace App\Actions\API\Category;

use app\Http\Requests\Category\IndexCategoryRequest;
use App\Models\Category;

final class GetCategoryAction
{
    public function execute(IndexCategoryRequest $request): array|\Illuminate\Database\Eloquent\Collection
    {
        return Category::all();
    }
}
