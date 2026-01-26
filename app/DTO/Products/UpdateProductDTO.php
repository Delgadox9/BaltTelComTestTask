<?php

declare(strict_types=1);

namespace app\DTO\Products;

use App\Http\Requests\Product\UpdateProductRequest;

final readonly class UpdateProductDTO
{
    public function __construct(
        public int $id,
        public ?string $name,
        public ?string $description,
        public ?float $price,
        public ?int $categoryId,
    ) {}

    public static function fromRequest(UpdateProductRequest $request): self
    {
        return new self(
            $request->integer('product'),
            $request->input('name'),
            $request->filled('description') ? $request->str('description') : null,
            $request->filled('price') ? $request->float('price') : null,
            $request->integer('category_id'),
        );
    }
}
