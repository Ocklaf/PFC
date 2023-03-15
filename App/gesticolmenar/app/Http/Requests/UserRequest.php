<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'explotation_code' => ['required',
            'regex:/^[A-Z0-9]*$/',
            'string',
            'min:10',
            'max:10',
            Rule::unique('users')->ignore($this->route('user'))],

            'name' => 'required|string|min:2|max:100',
            'surname' => 'required|string|min:2|max:100',
            'dni' => ['required',
            'regex:/^[0-9]{8,8}[A-Z]$/',
            'string',
            'min:9',
            'max:9',
            Rule::unique('users')->ignore($this->route('user'))],

            'email' => ['required',
            'string',
            'email',
            Rule::unique('users')->ignore($this->route('user'))],
            
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|string|min:6|same:password',
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
            'explotation_code.required' => 'El campo código de explotación es obligatorio',
            'explotation_code.string' => 'El código de explotación debe contener números y letras exclusivamente',
            'explotation_code.min' => 'El código de explotación debe tener 10 caracteres',
            'explotation_code.max' => 'El código de explotación debe tener 10 caracteres',
            'explotation_code.regex' => 'El código de explotación debe contener números y letras mayúsculas exclusivamente',
            'explotation_code.unique' => 'El código de explotación ya está en uso',
            'name.required' => 'El campo nombre es obligatorio',
            'name.string' => 'El campo nombre debe ser un texto',
            'name.between' => 'El campo nombre debe tener entre 2 y 100 caracteres',
            'surname.required' => 'El campo apellidos es obligatorio',
            'surname.string' => 'El campo apellidos debe ser un texto',
            'surname.between' => 'El campo apellidos debe tener entre 2 y 100 caracteres',
            'dni.required' => 'El campo DNI es obligatorio',
            'dni.string' => 'El campo DNI debe contener números y una letra mayúscula',
            'dni.min' => 'El campo DNI debe tener 9 caracteres',
            'dni.max' => 'El campo DNI debe tener 9 caracteres',
            'dni.regex' => 'El campo DNI debe contener 8 números y una letra mayúscula',
            'dni.unique' => 'El DNI ya está en uso',
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'El campo email debe ser un email válido',
            'email.unique' => 'El email ya está en uso',
            'password.required' => 'El campo contraseña es obligatorio',
            'password.min' => 'El campo contraseña debe tener al menos 6 caracteres',
            'password_confirmation.min' => 'El campo contraseña debe tener al menos 6 caracteres',
            'password_confirmation.required' => 'El campo confirmación de contraseña es obligatorio',
            'password_confirmation.same' => 'El campo confirmación de contraseña debe ser igual al campo contraseña',
        ];
    }
    
}