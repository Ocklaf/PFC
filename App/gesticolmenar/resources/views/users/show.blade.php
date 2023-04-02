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

                        <div class="col-md-4 gradient-custom text-center text-white "
                            style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                            <i class="bi bi-person-lines-fill" style="font-size: 4rem; color: #461400"></i>
                            <h5 class="text-black">{{ $user->name }}</h5>
                            <p class="text-black">{{ $user->surname }}</p>
                            <div class="row d-flex justify-content-center">
                                <div class="col-3">
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-success"><i
                                            class="bi bi-pencil"></i></a>
                                </div>
                                <div class="col-3">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </div>
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



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">¡Cuidado!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que quieres eliminar este usuario?</p>
                    <p>Esta acción es irreversible y eliminará todos los datos</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
                    <form class="" action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
