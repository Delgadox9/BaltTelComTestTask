<?php

declare(strict_types=1);

namespace app\DTO\Products;

use Illuminate\Support\Arr;

final readonly class DeleteProductDTO
{
    public function __construct(
        public int $id,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            (int) Arr::get($data, 'id', 1),
        );
    }
}
