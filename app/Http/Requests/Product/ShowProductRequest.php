<?php

namespace App\Http\Requests\Product;

use App\DTO\Product\ShowProductDTO;
use Illuminate\Foundation\Http\FormRequest;

class ShowProductRequest extends FormRequest
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
            'product' => ['integer', 'min:0', 'required', 'exists:products,id'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'product' => $this->route('product'),
        ]);
    }

    public function getDTO(): ShowProductDTO
    {
        return ShowProductDTO::fromArray($this->validated());
    }
}
