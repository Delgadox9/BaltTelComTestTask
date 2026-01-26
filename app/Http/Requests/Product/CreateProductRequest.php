<?php

namespace App\Http\Requests\Product;

use app\DTO\Products\CreateProductDTO;
use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'sometimes|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'integer|required|exists:categories,id',
        ];
    }

    public function getDTO(): CreateProductDTO
    {
        return CreateProductDTO::fromArray($this->validated());
    }
}
