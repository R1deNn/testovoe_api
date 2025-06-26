<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|uuid|exists:products,id',
            'qty' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'product_id.uuid' => 'Некорректный формат UUID. Используйте формат типа: 123e4567-e89b-12d3-a456-426614174000',
            'product_id.required' => 'ID продукта является обязательным полем',
            'product_id.exists' => 'Такого ID не существует',
            'qty.required' => 'Необходимо задать количество товара',
            'qty.integer' => 'Поле qty должно быть формата integer',
            'qty.min' => 'Поле qty должно быть минимум 1'
        ];
    }
}
