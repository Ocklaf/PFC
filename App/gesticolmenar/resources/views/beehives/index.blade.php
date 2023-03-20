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
                <h1 class="mt-4 text-center">Colmenas</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('beehives.addBeehiveToApiary', $apiary) }}" class="btn btn-primary">Añadir Colmena</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">

                @if($beehives->count() > 0)

                <table class="table text-center" style="width: 100%; overflow: hidden">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Tipo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($beehives as $beehive)
                            @if($beehive->diseases()->get()->count() > 0)
                                <tr class="table-danger">
                                    <td><i class="bi bi-heart-pulse"></i> {{ $beehive->user_code }}</td>
                            @else
                            <tr>
                                <td>{{ $beehive->user_code }} </td>
                            @endif
                                <td>{{ $beehive->type }}</td>
                                <td class="d-flex justify-content-evenly">
                                    <a href="{{ route('beehives.show', $beehive->id) }}" class="btn btn-primary"><i
                                            class="bi bi-eye"></i></a>

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

                @else
                <div class="alert alert-info text-center mt-5">
                    No hay colmenas registradas
                </div>
                @endif

                <div class="d-flex justify-content-center mt-5">
                    {{ $beehives->links() }}
                </div>
                
            </div>
        </div>
    </div>
@endsection
