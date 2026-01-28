<?php

namespace App\Actions\API\Product;

use App\DTO\Product\DeleteProductDTO;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

final class DeleteProductAction
{
    /**
     * @throws \Throwable
     */
    public function execute(DeleteProductDTO $dto): \Illuminate\Http\JsonResponse
    {
        return DB::transaction(function () use ($dto) {
            if (Product::find($dto->id)->delete()) {
                return response([
                    'message' => 'Продукт успешно удален',
                ])->json();
            }

            return response([
                'message' => 'Ошибка при удаление продукта',
            ], 500)->json();
        });
    }
}
