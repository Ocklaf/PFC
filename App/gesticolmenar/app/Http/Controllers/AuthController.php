<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    public function register(AuthRequest $request)
    {
        $user = new User();
        $user->explotation_code = $request->explotation_code;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->dni = $request->dni;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('/')->withSuccess('Usuario registrado correctamente');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'El campo email debe ser un email válido',
            'password.required' => 'El campo contraseña es obligatorio',
            'password.min' => 'El campo contraseña debe tener al menos 6 caracteres',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['error' => 'Email o contraseña incorrectos']);
        }

        $user = Auth::user();
        /** @var \App\Models\MyUserModel $user **/
        $token = $user->createToken('AuthToken')->accessToken;

        return redirect('apiaries')
            ->withSuccess('Hola ' . $user->name . '!!')
            ->withInput(['user' => $user, 'access_token' => $token]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
