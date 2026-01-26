<?php

namespace App\Http\Requests\Product;

use App\DTO\Product\DeleteProductDTO;
use Illuminate\Foundation\Http\FormRequest;

class DeleteProductRequest extends FormRequest
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
            'id' => 'integer|min:0|required|exists:products,id',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('product'),
        ]);
    }

    public function getDTO(): DeleteProductDTO
    {
        return DeleteProductDTO::fromArray($this->validated());
    }
}
