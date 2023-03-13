@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Colmenares</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('apiaries.create') }}" class="btn btn-primary">Crear Colmena</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Nombre Ubicación</th>
                            <th>Número de colmenas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apiaries as $apiary)
                            <tr>
                                <td>{{ $apiary->place_name }}</td>
                                <td>{{ $apiary->beehives_quantity }}</td>
                                <td class="d-flex justify-content-evenly">
                                    <a  href="{{ route('beehives.beehivesApiary', $apiary->id) }}" class="btn btn-primary"><i
                                            class="bi bi-eye"></i></a>
                                    <a href="{{ route('apiaries.edit', $apiary->id) }}" class="btn btn-primary"><i
                                            class="bi bi-pencil"></i></a>
                                    <form action="{{ route('apiaries.destroy', $apiary->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash3"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
