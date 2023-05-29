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
                @if ($totalTasks)
                    <a class="btn btn-primary" href="{{ route('apiaries.apiariesTasks') }}">
                        Tareas <span class="badge text-bg-danger ms-2">{{ $totalTasks }}</span>
                    </a>
                @endif
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
                                    <td class="text-center col-6">
                                        <div class="btn-toolbar  d-flex justify-content-evenly" role="toolbar" aria-label="Acciones">
                                            <div class="btn-group mr-2" role="group" aria-label="Ver">
                                                <a href="{{ route('beehives.beehivesApiary', $apiary->id) }}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                                            </div>
                                            <div class="btn-group mr-2" role="group" aria-label="Editar">
                                                <a href="{{ route('apiaries.edit', $apiary->id) }}" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                                            </div>
                                            <div class="btn-group" role="group" aria-label="Eliminar">
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$apiary->id}}"><i class="bi bi-trash3"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row text-center mt-5 ">
                        <h3>Gráficas por colmenares</h3>
                        <div class="col d-flex justify-content-center">
                            <form action="{{ route('charts.honeyApiaries') }}" method="POST">
                                @csrf
                                @method('GET')
                                <div class="row d-flex justify-content-center">
                                    <div class="col-auto">
                                        <select class="form-select me-4 mt-3 text-center" style="width: 160px" name="year"
                                            id="year">
                                            @foreach ($years as $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-auto me-4">
                                        <button type="submit" class="btn btn-primary mt-3 btn-block"
                                            style="width: 160px">Gráfica Miel</button>
                                    </div>
                                    <div class="col-12 col-sm-auto me-4">
                                        <button type="submit" class="btn btn-primary mt-3 btn-block" style="width: 160px"
                                            formaction="{{ route('charts.pollenApiaries') }}">Gráfica Polen</button>
                                    </div>
                                    <div class="col-12 col-sm-auto me-4">
                                        <button type="submit" class="btn btn-primary mt-3 btn-block" style="width: 160px"
                                            formaction="{{ route('charts.apitoxineApiaries') }}">Gráfica Apitoxina</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row text-center mt-5">
                        <h3>Gráficas de los históricos</h3>
                        <div class="col d-flex justify-content-center">
                            <div class="row d-flex justify-content-center">

                            <div class="col-10 col-md-4 col-lg-3 me-4">
                                <a class="btn btn-primary btn-block mt-3" style="width: 160px"
                                    href="{{ route('charts.totalHoney', json_encode($years)) }}">Totales Miel</a>
                            </div>
                            <div class="col-10 col-md-4 col-lg-3 me-4">
                                <a class="btn btn-primary btn-block mt-3" style="width: 160px"
                                    href="{{ route('charts.totalPollen', json_encode($years)) }}">Totales Polen</a>
                            </div>
                            <div class="col-10 col-md-4 col-lg-3 me-4">
                                <a class="btn btn-primary btn-block mt-3" style="width: 160px"
                                    href="{{ route('charts.totalApitoxine', json_encode($years)) }}">Totales Apitoxina</a>
                            </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info text-center mt-5">
                        No hay colmenares registrados
                    </div>
                @endif

            </div>
        </div>


        <!-- Modals -->
        @if ($apiaries->count() > 0)
        @foreach ($apiaries as $apiary)
            <div class="modal fade" id="deleteModal{{$apiary->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
        @endforeach
        @endif
    @endsection
