@extends('layouts.app')

@section('content')
    <section class="container" style="margin-bottom: 110px">

        @if (!count($freePlaces))
            <div class="row d-flex justify-content-center mt-4">
                <div class="col-lg-6 col-md-8">
                    @if ($path === 'apiaries.update')
                        <div class="alert alert-danger text-center">
                            No existen Ubicaciones disponibles, debes añadir una antes de editar la ubicación.
                        </div>
                    @else
                        <div class="alert alert-danger text-center">
                            No existen Ubicaciones disponibles, debes añadir una antes de añadir un colmenar.
                        </div>
                    @endif
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="text-center">
                        <a href="{{ route('places.create') }}" class="btn btn-primary">Añadir Ubicación</a>
                    </div>
                </div>
            </div>
        @endif

        <div class="row d-flex justify-content-center mt-5">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        @if ($path === 'apiaries.update')
                            <h3 class="text-uppercase text-center mb-1">Editar Colmenar</h3>
                        @else
                            <h3 class="text-uppercase text-center mb-1">Añadir Colmenar</h3>
                        @endif

                        <form action="{{ route($path, $apiary) }}" method="POST">
                            @csrf
                            @if ($path === 'apiaries.update')
                                @method('PATCH')
                            @endif

                            @if (count($freePlaces))
                                <label class="form-label" for="type">Emplazamiento</label>
                                <select class="form-select form-select-lg" name="place_id" id="place_id">
                                    @foreach ($freePlaces as $place)
                                        <option value="{{ $place->id }}">{{ $place->name }}</option>
                                    @endforeach
                                </select>
                            @endif

                            @if (count($freePlaces))
                                <div class="d-flex justify-content-evenly mt-4">
                                    @if ($path === 'apiaries.update')
                                        <button type="submit"
                                            class="btn btn-primary btn-block  gradient-custom text-white">Editar</button>
                                    @else
                                        <button type="submit"
                                            class="btn btn-primary btn-block  gradient-custom text-white">Añadir</button>
                                    @endif

                                    <a href="{{ route('apiaries.index') }}"
                                        class="btn btn-danger btn-block  gradient-custom text-white">Cancelar</a>
                                </div>
                            @endif

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
