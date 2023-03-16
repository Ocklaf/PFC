<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'string', 'max:9'],
            'grams' => ['required', 'integer', 'min:0'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'type.required' => 'El tipo de producto es obligatorio',
            'type.string' => 'El tipo de producto debe ser un texto',
            'type.max' => 'El tipo de producto no puede tener más de 9 caracteres',
            'grams.required' => 'La cantidad de producto es obligatoria',
            'grams.integer' => 'La cantidad de producto debe ser un número entero',
            'grams.min' => 'La cantidad de producto debe ser un número positivo',
        ];
    }
}
