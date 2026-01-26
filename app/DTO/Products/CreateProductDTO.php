<?php

declare(strict_types=1);

namespace app\DTO\Products;

use Illuminate\Support\Arr;

final readonly class CreateProductDTO
{
    public function __construct(
        public string $name,
        public string $description,
        public float $price,
        public int $categoryId,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            Arr::get($data, 'name'),
            Arr::get($data, 'description') ?? '',
            (float) Arr::get($data, 'price'),
            (int) Arr::get($data, 'category_id'),
        );
    }
}
