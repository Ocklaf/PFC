<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) {
        //
    }

    public function register(AuthRequest $request) {
        // $validator = Validator::make($request->all(), [
        //     'explotation_code' => 'required|string|min:10|max:10',
        //     'name' => 'required|string',
        //     'surname' => 'required|string',
        //     'dni' => 'required|string|min:9|max:9',
        //     'email' => 'required|string|email|unique:users',
        //     'password' => 'required|string|min:6|confirmed',
        // ]);

        // if ($validator->fails()) {
        //     return back()->withErrors($validator->errors())->withInput($request->all());
        // }

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

    public function login(Request $request) {
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
        // dd($credentials);
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

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
    }
}
