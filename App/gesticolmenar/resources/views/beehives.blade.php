@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-4 text-center">Colmenas</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('beehives.create') }}" class="btn btn-primary">Crear Colmena</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Tipo Colmena</th>
                            <th>Marcos de miel</th>
                            <th>Marcos de polen</th>
                            <th>Marcos de cría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($beehives as $beehive)
                            <tr>
                                <td>{{ $beehive->type }}</td>
                                <td>{{ $beehive->honey_frames }}</td>
                                <td>{{ $beehive->pollen_frames }}</td>
                                <td>{{ $beehive->brood_frames }}</td>
                                <td class="d-flex justify-content-evenly">
                                    <a href="{{ route('beehives.show', $beehive->id) }}" class="btn btn-primary"><i
                                            class="bi bi-eye"></i></a>
                                    <a href="{{ route('beehives.edit', $beehive->id) }}" class="btn btn-primary"><i
                                            class="bi bi-pencil"></i></a>
                                    <form action="{{ route('beehives.destroy', $beehive->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash3"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-5">
                    {{ $beehives->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
