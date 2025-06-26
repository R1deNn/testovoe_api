<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'qty' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'qty.required' => 'Необходимо задать количество товара',
            'qty.integer' => 'Поле qty должно быть формата integer',
            'qty.min' => 'Поле qty должно быть минимум 1'
        ];
    }
}
