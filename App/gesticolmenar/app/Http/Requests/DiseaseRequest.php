<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiseaseRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'treatment_start_date' => ['required', 'date'],
            'treatment_repeat_date' => ['required', 'integer'],
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
            'name.required' => 'El campo nombre es obligatorio',
            'name.string' => 'El campo nombre debe ser un texto',
            'name.max' => 'El campo nombre no puede tener más de 255 caracteres',
            'treatment_start_date.required' => 'El campo fecha de inicio del tratamiento es obligatorio',
            'treatment_start_date.date' => 'El campo fecha de inicio del tratamiento debe ser una fecha',
            'treatment_repeat_date.required' => 'El campo días de repetición del tratamiento es obligatorio',
            'treatment_repeat_date.integer' => 'El campo días de repetición del tratamiento debe ser un número entero',
        ];
    }
}
