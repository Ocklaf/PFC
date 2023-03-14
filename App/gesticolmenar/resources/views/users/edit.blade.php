@extends('layouts.app')

@section('content')
    <section style="margin-bottom: 110px">

        <div class="container">
            <div class="row d-flex justify-content-center align-items-center vh-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-4">
                            <h3 class="text-uppercase text-center mb-1">Editar Perfil</h3>

                            <form action="{{ route('users.update', $user) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="form-outline mb-1">
                                    <label class="form-label" for="name">Nombre</label>
                                    <input type="text" id="name" name="name" class="form-control form-control-lg"
                                        value="{{ old('name', $user->name) }}" />
                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>

                                <div class="form-outline mb-1">
                                    <label class="form-label" for="surname">Apellidos</label>
                                    <input type="text" id="surname" name="surname" class="form-control form-control-lg"
                                        value="{{ old('surname', $user->surname) }}" />
                                    @if ($errors->has('surname'))
                                        <p class="text-danger">{{ $errors->first('surname') }}</p>
                                    @endif
                                </div>

                                <div class="form-outline mb-1">
                                    <label class="form-label" for="dni">DNI</label>
                                    <input type="text" id="dni" name="dni" class="form-control form-control-lg"
                                        value="{{ old('dni', $user->dni) }}" />
                                    @if ($errors->has('dni'))
                                        <p class="text-danger">{{ $errors->first('dni') }}</p>
                                    @endif
                                </div>

                                <div class="form-outline mb-1">
                                    <label class="form-label" for="explotation_code">Código Explotación Ganadera</label>
                                    <input type="text" id="explotation_code" name="explotation_code"
                                        class="form-control form-control-lg" value="{{ old('explotation_code', $user->explotation_code) }}" />
                                    @if ($errors->has('explotation_code'))
                                        <p class="text-danger">{{ $errors->first('explotation_code') }}</p>
                                    @endif
                                </div>

                                <div class="form-outline mb-1">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control form-control-lg"
                                        value="{{ old('email', $user->email) }}" />
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
                                {{-- 
                                    <div class="form-check d-flex justify-content-center mb-5">
                                        <input class="form-check-input me-2" type="checkbox" value=""
                                            id="form2Example3cg" />
                                        <label class="form-check-label" for="form2Example3g">
                                            He leído los <a href="#!" class="text-body"><u>Términos y condiciones</u></a>
                                        </label>
                                    </div> --}}

                                <div class="d-flex justify-content-evenly">
                                    <button type="submit"
                                        class="btn btn-primary btn-block  gradient-custom text-white">Editar</button>
                                        <a
                                        href="{{ route('login') }}" class="btn btn-danger btn-block  gradient-custom text-white">Cancelar</a>
                                </div>

                                

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection