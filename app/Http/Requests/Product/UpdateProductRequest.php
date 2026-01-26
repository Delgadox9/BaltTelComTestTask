<?php

namespace App\Http\Requests\Product;

use App\DTO\Product\UpdateProductDTO;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product' => 'integer|min:0|required|exists:products,id',
            'name' => 'string',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
            'category_id' => 'required|integer|exists:categories,id',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'product' => $this->route('product'),
        ]);
    }

    public function getDTO(): UpdateProductDTO
    {
        return UpdateProductDTO::fromRequest($this);
    }
}
