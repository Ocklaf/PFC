@extends('layouts.loginAndRegister')
@section('title', 'Registro de Usuario')
@section('content')
    <section>

        <div class="container">
            <div class="row d-flex justify-content-center align-items-center vh-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-4">
                            <h3 class="text-uppercase text-center mb-1">Regístrate</h3>

                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="form-outline mb-1">
                                    <label class="form-label" for="name">Nombre</label>
                                    <input type="text" id="name" name="name" class="form-control form-control-lg"
                                        value="{{ old('name') }}" />
                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>

                                <div class="form-outline mb-1">
                                    <label class="form-label" for="surname">Apellidos</label>
                                    <input type="text" id="surname" name="surname" class="form-control form-control-lg"
                                        value="{{ old('surname') }}" />
                                    @if ($errors->has('surname'))
                                        <p class="text-danger">{{ $errors->first('surname') }}</p>
                                    @endif
                                </div>

                                <div class="form-outline mb-1">
                                    <label class="form-label" for="dni">DNI</label>
                                    <input type="text" id="dni" name="dni" class="form-control form-control-lg"
                                        value="{{ old('dni') }}" />
                                    @if ($errors->has('dni'))
                                        <p class="text-danger">{{ $errors->first('dni') }}</p>
                                    @endif
                                </div>

                                <div class="form-outline mb-1">
                                    <label class="form-label" for="explotation_code">Código Explotación Ganadera</label>
                                    <input type="text" id="explotation_code" name="explotation_code"
                                        class="form-control form-control-lg" value="{{ old('explotation_code') }}" />
                                    @if ($errors->has('explotation_code'))
                                        <p class="text-danger">{{ $errors->first('explotation_code') }}</p>
                                    @endif
                                </div>

                                <div class="form-outline mb-1">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control form-control-lg"
                                        value="{{ old('email') }}" />
                                    @if ($errors->has('email'))
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>

                                <div class="form-outline mb-1">
                                    <label class="form-label" for="password">Contraseña</label>
                                    <input type="password" id="password" name="password"
                                        class="form-control form-control-lg" />
                                    @if ($errors->has('password'))
                                        <p class="text-danger">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>

                                <div class="form-outline mb-3">
                                    <label class="form-label" for="password_confirmation">Repite contraseña</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control form-control-lg" />
                                    @if ($errors->has('password_confirmation'))
                                        <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                                    @endif
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit"
                                        class="btn btn-primary btn-block btn-lg gradient-custom text-white">Registrarse</button>
                                </div>

                                <p class="text-center text-muted mt-3 mb-0">¿Ya tienes una cuenta?
                                    <a href="{{ route('login') }}" class="fw-bold text-body">Login aquí</a>
                                </p>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
