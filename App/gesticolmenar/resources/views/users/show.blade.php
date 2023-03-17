@extends('layouts.app')

@section('content')
    <div class="container-fluid py-5 h-100" style="margin-bottom: 110px">
        @if (session('success'))
            <div class="row  d-flex justify-content-center">
                <div class="alert alert-success text-center mb-3 col-6">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-6 mb-4 mb-lg-0">
                <div class="card p-5 mb-3 user-card" style="border-radius: .5rem;">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center text-white"
                            style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                            <i class="bi bi-person-lines-fill" style="font-size: 4rem; color: #461400"></i>
                            <h5 class="text-black">{{ $user->name }}</h5>
                            <p class="text-black">{{ $user->surname }}</p>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-success"><i
                                class="bi bi-pencil"></i></a>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6>Datos del perfil</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-12 mb-3">
                                        <h6>Email</h6>
                                        <p class="text-muted">{{ $user->email }}</p>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <h6>DNI</h6>
                                        <p class="text-muted">{{ $user->dni }}</p>
                                    </div>
                                    <div class="col-12">
                                        <h6>Código de explotación ganadera</h6>
                                        <p class="text-muted">{{ $user->explotation_code }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
