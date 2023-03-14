<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'catastral_code' => 'required|string|max:255',
            'poligon' => 'required|string|max:255',
            'parcel' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'has_water' => 'required|boolean',
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
            'name.max' => 'El nombre no puede tener más de 255 caracteres',
            'catastral_code.required' => 'El código catastral es obligatorio',
            'catastral_code.string' => 'El código catastral debe ser una cadena de texto',
            'catastral_code.max' => 'El código catastral no puede tener más de 255 caracteres',
            'poligon.required' => 'El polígono es obligatorio',
            'poligon.string' => 'El polígono debe ser una cadena de texto',
            'poligon.max' => 'El polígono no puede tener más de 255 caracteres',
            'parcel.required' => 'La parcela es obligatoria',
            'parcel.string' => 'La parcela debe ser una cadena de texto',
            'parcel.max' => 'La parcela no puede tener más de 255 caracteres',
            'postal_code.required' => 'El código postal es obligatorio',
            'postal_code.string' => 'El código postal debe ser una cadena de texto',
            'postal_code.max' => 'El código postal no puede tener más de 255 caracteres',
            'has_water.required' => 'El campo de agua es obligatorio',
            'has_water.boolean' => 'El campo de agua debe ser un booleano',
        ];
    }
}
