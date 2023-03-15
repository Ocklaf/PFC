<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlaceRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array {
        return [
            'name' => 'required|string|regex:/^[A-Z ]+$/i|min:3|max:100',
            'catastral_code' => [
                'required',
                'string',
                'regex:/^[A-Z0-9]+$/',
                'min:20',
                'max:20',
                Rule::unique('places')->ignore($this->route('place'))
            ],
            'poligon' => 'required|string|max:3',
            'parcel' => 'required|string|max:5',
            'postal_code' => [
                'required',
                'string',
                'regex:/^(?:0[1-9]|[1-4]\d|5[0-2])\d{3}$/',
                'min:5',
                'max:5']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array {
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.string' => 'El nombre debe ser una cadena de texto',
            'name.regex' => 'Sólo puede contener letras',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'name.max' => 'El nombre no puede tener más de 100 caracteres',
            'catastral_code.required' => 'La referencia catastral es obligatoria',
            'catastral_code.string' => 'La referencia catastral debe ser un código alfanumérico',
            'catastral_code.regex' => 'Sólo letras en mayúsculas y números',
            'catastral_code.min' => 'La referencia catastral debe tener 20 caracteres',
            'catastral_code.max' => 'La referencia catastral debe tener 20 caracteres',
            'catastral_code.unique' => 'La referencia catastral ya existe',
            'poligon.required' => 'El polígono es obligatorio',
            'poligon.string' => 'El polígono debe ser un número',
            'poligon.max' => 'El polígono no puede tener más de 3 caracteres',
            'parcel.required' => 'La parcela es obligatoria',
            'parcel.string' => 'La parcela debe ser un número',
            'parcel.max' => 'La parcela no puede tener más de 5 caracteres',
            'postal_code.required' => 'El código postal es obligatorio',
            'postal_code.string' => 'El código postal debe ser un número',
            'postal_code.min' => 'El código postal debe tener 5 caracteres',
            'postal_code.max' => 'El código postal debe tener 5 caracteres',
            'postal_code.regex' => 'El código postal debe tener el formato numérico 00000',
        ];
    }
}
