<?php

declare(strict_types=1);

namespace App\DTO\Category;

use Illuminate\Support\Arr;

final readonly class IndexCategoryDTO
{
    public function __construct(
        public int $page,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            (int) Arr::get($data, 'page', 1),
        );
    }
}
