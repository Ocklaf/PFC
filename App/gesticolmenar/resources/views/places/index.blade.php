@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-5" style="margin-bottom: 110px">
        @if (session('success'))
            <div class="row  d-flex justify-content-center mt-5">
                <div class="alert alert-success text-center mb-3 col-6">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Ubicaciones</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('places.create') }}" class="btn btn-primary">Añadir Ubicación</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">

                @if ($places->count() > 0)

                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>Nombre del Lugar</th>
                                <th>Referencia catastral</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($places as $place)

                                @if (!$place->apiary()->count())
                                    <tr class="table-success">
                                        <td>{{ $place->name }}</td>
                                    @else
                                    <tr>
                                        <td>{{ $place->name }}</td>
                                @endif
                                
                                <td>{{ $place->catastral_code }}</td>
                                <td class="d-flex justify-content-evenly">
                                    <a href="{{ route('places.show', $place->id) }}" class="btn btn-primary"><i
                                            class="bi bi-eye"></i></a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"><i class="bi bi-trash3"></i></button>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                @else
                    <div class="alert alert-info text-center mt-5">
                        No hay ubicaciones registradas
                    </div>
                @endif

            </div>
        </div>


        <!-- Modal -->
        @if ($places->count() > 0)
            <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteModalLabel">¡Advertencia!</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que quieres eliminar esta ubicación? Esta acción no se puede deshacer. El
                            colmenar asociado junto con todas las colmenas serán eliminadas.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
                            <form action="{{ route('places.destroy', $place) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endsection
