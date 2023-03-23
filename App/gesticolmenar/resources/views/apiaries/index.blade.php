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
                <h1 class="text-center">Colmenares</h1>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12">
                <a class="btn btn-primary" href="{{ route('apiaries.create') }}">Añadir Colmenar</a>
                <a class="btn btn-primary" href="{{ route('apiaries.apiariesTasks') }}">
                    Colmenares con tareas <span class="badge text-bg-danger ms-2">{{ $apiariesTasks }}</span>
                  </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">

                @if ($apiaries->count() > 0)
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>Ubicación</th>
                                <th>Colmenas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apiaries as $apiary)
                                <tr>
                                    <td>{{ $apiary->place_name }}</td>
                                    <td>{{ $apiary->beehives_quantity }}</td>
                                    <td class="d-flex justify-content-evenly">
                                        <a href="{{ route('beehives.beehivesApiary', $apiary->id) }}"
                                            class="btn btn-primary"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('apiaries.edit', $apiary->id) }}" class="btn btn-primary"><i
                                                class="bi bi-pencil"></i></a>

                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"><i class="bi bi-trash3"></i></button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row text-center mt-5 d-flex justify-content-start">
                        <div class="col-lg-4 col">
                            <form action="{{ route('charts.honeyApiaries') }}" method="POST">
                                @csrf
                                @method('GET')
                                <div class="row">
                                    <div class="col">
                                        <select class="form-select" name="year" id="year">
                                            @foreach ($years as $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col text-start">
                                        <button type="submit" class="btn btn-primary">Gráfica Miel</button>
                                    </div>
                                    <div class="col text-start">
                                        <a class="btn btn-primary"
                                            href="{{ route('charts.totalHoney', json_encode($years)) }}">Totales Miel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row text-center mt-5 d-flex justify-content-start">
                        <div class="col-lg-4 col">
                            <form action="{{ route('charts.pollenApiaries') }}" method="POST">
                                @csrf
                                @method('GET')
                                <div class="row">
                                    <div class="col">
                                        <select class="form-select" name="year" id="year">
                                            @foreach ($years as $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col text-start">
                                        <button type="submit" class="btn btn-primary">Gráfica Polen</button>
                                    </div>
                                    <div class="col text-start">
                                        <a class="btn btn-primary"
                                            href="{{ route('charts.totalPollen', json_encode($years)) }}">Totales Polen</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row text-center mt-5 d-flex justify-content-start mb-5">
                        <div class="col-lg-4 col">
                            <form action="{{ route('charts.apitoxineApiaries') }}" method="POST">
                                @csrf
                                @method('GET')
                                <div class="row">
                                    <div class="col">
                                        <select class="form-select" name="year" id="year">
                                            @foreach ($years as $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col text-start">
                                        <button type="submit" class="btn btn-primary">Gráfica Apitoxina</button>
                                    </div>
                                    <div class="col text-start">
                                        <a class="btn btn-primary"
                                            href="{{ route('charts.totalApitoxine', json_encode($years)) }}">Totales Apitoxina</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info text-center mt-5">
                        No hay colmenares registrados
                    </div>
                @endif

            </div>
        </div>


        <!-- Modal -->
        @if ($apiaries->count() > 0)
            <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteModalLabel">¡Advertencia!</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que quieres eliminar este colmenar? Esta acción no se puede deshacer. Todas las
                            colmenas serán eliminadas.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
                            <form action="{{ route('apiaries.destroy', $apiary->id) }}" method="POST">
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
