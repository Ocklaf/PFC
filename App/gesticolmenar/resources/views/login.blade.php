@extends('layouts.loginAndRegister')

@section('title', 'Login')

@section('content')
    <section class="vh-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 vh-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="{{ asset('img/logo.png') }}" style="width: 185px;" alt="logo">
                                        <h4 class="mt-3 mb-5 pb-1">APP GESTICOLMENAR</h4>
                                    </div>

                                    <form id="loginForm" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Introduce tu email" value="{{ old('email') }}" />
                                            @if ($errors->has('email'))
                                                <p class="text-danger">{{ $errors->first('email') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">Contraseña</label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Introduce tu contraseña" />
                                            @if ($errors->has('password'))
                                                <p class="text-danger">{{ $errors->first('password') }}</p>
                                            @endif

                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom mb-3"
                                                type="submit">Entrar</button>
                                            {{-- <a class="text-muted" href="#!">Forgot password?</a> --}}
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">¿No tienes una cuenta?</p>
                                            <a type="button" class="btn btn-outline-danger"
                                                href="{{ route('register') }}">Regístrate</a>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom">
                                <div class="px-3 py-4 p-md-5 mx-md-4">
                                    <h3 class="text-white mb-4 text-center">La gestión de tus colmenas</h3>
                                    <p class="text-white small mb-0">Aplicación Web creada para la gestión de la información
                                        relacionada con
                                        las colmenas, colmenares, ubicación, enfermedades, reinas, recolectas, etc.
                                    </p>
                                    <p class="text-white small mt-2">Completamente gratuita y sin coste alguno, simplemente,
                                        regístrate y empieza a tener toda la información localizada en un solo lugar.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
