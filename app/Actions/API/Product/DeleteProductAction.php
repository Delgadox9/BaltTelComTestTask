<?php

namespace App\Actions\API\Product;

use app\DTO\Products\DeleteProductDTO;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

final class DeleteProductAction
{
    /**
     * @throws \Throwable
     */
    public function execute(DeleteProductDTO $dto): \Illuminate\Http\Response
    {
        return DB::transaction(function () use ($dto) {
            if (Product::find($dto->id)->delete()) {
                return response('Продукт успешно удален');
            }

            return response('Ошибка при удаление продукта', 500);
        });
    }
}
