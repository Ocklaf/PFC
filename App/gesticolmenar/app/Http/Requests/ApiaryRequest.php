<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiaryRequest extends FormRequest
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
            'others' => ['nullable', 'string', 'max:1000'],
            'place_id' => ['required', 'integer', 'exists:places,id'],
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
            'others.string' => 'El campo otros debe ser un texto',
            'others.max' => 'El campo otros no puede tener más de 1000 caracteres',
            'place_id.required' => 'El campo lugar es obligatorio',
            'place_id.integer' => 'El campo lugar debe ser un número entero',
            'place_id.exists' => 'El lugar seleccionado no existe',
        ];
    }
}
