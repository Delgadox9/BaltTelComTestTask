<?php

declare(strict_types=1);

namespace App\DTO\Product;

use App\Http\Requests\Product\IndexProductRequest;
use Illuminate\Support\Arr;

final readonly class IndexProductDTO
{
    public function __construct(
        public int $page,
        public ?int $search,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            (int) Arr::get($data, 'page', 1),
            (int) Arr::get($data, 'search', 1),
        );
    }

    public static function fromRequest(IndexProductRequest $request): self
    {
        return new self(
            $request->integer('page'),
            $request->filled('search') ? $request->integer('search') : null,
        );
    }
}
