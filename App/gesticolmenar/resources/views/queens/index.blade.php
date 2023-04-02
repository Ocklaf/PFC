@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="margin-bottom: 110px">
        @if (session('success'))
            <div class="row  d-flex justify-content-center mt-5">
                <div class="alert alert-success text-center mb-3 col-6">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <h1 class="mt-4 text-center">Reinas disponibles</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('queens.create') }}" class="btn btn-primary">Añadir Reina</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if ($queens->count() > 0)
                
                    <table class="table text-center" style="width: 100%; overflow: hidden">
                        <thead>
                            <tr>
                                <th>Raza</th>
                                <th>Color</th>
                                <th>Cambio</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($queens as $queen)
                                @if (date('Y') === $queen->end_date)
                                    <tr class="table-danger">
                                    @else
                                    <tr>
                                @endif
                                <td>{{ $queen->race }}</td>
                                <td>{{ $queen->color }}</td>
                                <td>{{ $queen->end_date }}</td>
                                <td class="d-flex justify-content-evenly">
                                    <a href="{{ route('queens.edit', $queen->id) }}" class="btn btn-primary"><i
                                        class="bi bi-pencil"></i></a>
                                    <form action="{{ route('queens.destroy', $queen->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash3"></i></button>
                                    </form>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                @else
                    <div class="alert alert-info text-center mt-5">
                        No hay reinas registradas
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
