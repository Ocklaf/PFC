<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BeehiveRequest extends FormRequest {
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
            'user_code' => ['required', 'string', Rule::unique('beehives')->ignore($this->route('beehive'))],
            'type' => 'required|string',
            'honey_frames' => 'required|integer',
            'pollen_frames' => 'required|integer',
            'brood_frames' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if ($this->brood_frames + $this->pollen_frames + $this->honey_frames > 10) {
                        $fail('El total de cuadros no puede exceder de 10');
                    }
                }
            ],
            'queen_id' => 'required|integer',
            'apiary_id' => 'required|integer',

            //checkFrames('honey_frames', 'pollen_frames', 'brood_frames');
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array {
        return [
            'user_code.required' => 'El código de la colmena es obligatorio',
            'user_code.unique' => 'El código de la colmena ya existe',
            'user_code.string' => 'El código de la colmena debe ser una cadena de texto',
            'type.required' => 'El tipo de colmena es obligatorio',
            'honey_frames.required' => 'El número de cuadros de miel es obligatorio',
            'pollen_frames.required' => 'El número de cuadros de polen es obligatorio',
            'brood_frames.required' => 'El número de cuadros de cría es obligatorio',
            'queen_id.required' => 'La reina es obligatoria',
            'apiary_id.required' => 'La colmena debe pertenecer a una colmenar',
        ];
    }
}
