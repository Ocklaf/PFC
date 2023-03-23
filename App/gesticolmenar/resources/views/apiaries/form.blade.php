@extends('layouts.app')

@section('content')
    <section class="container" style="margin-bottom: 110px">

        @if (!count($freePlaces) && $path === 'apiaries.store')
            <div class="row d-flex justify-content-center mt-4">
                <div class="col-lg-6 col-md-8">
                    {{-- @if ($path === 'apiaries.store') --}}
                    <div class="alert alert-danger text-center">
                        No existen Ubicaciones disponibles, debes añadir una antes de añadir un colmenar.
                    </div>
                    {{-- @else
                        <div class="alert alert-danger text-center">
                            No existen Ubicaciones disponibles, debes añadir una antes de añadir un colmenar.
                        </div> --}}
                    {{-- @endif --}}
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
                                <div class="form-outline">
                                    <label class="form-label" for="type">Emplazamiento</label>
                                    <select class="form-select form-select-lg" name="place_id" id="place_id">
                                        @foreach ($freePlaces as $place)
                                            <option value="{{ $place->id }}">{{ $place->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-outline mt-2 mb-1">
                                    <label class="form-label" for="last_visit">Fecha visita al colmenar</label>
                                    @if ($apiary->last_visit === null)
                                        <input class="form-control form-control-lg" type="date" name="last_visit"
                                            id="last_visit">
                                    @else
                                        <input class="form-control form-control-lg" type="date" name="last_visit"
                                            id="last_visit"
                                            value="{{ old('last_visit', date('Y-m-d', strtotime($apiary->last_visit))) }}">
                                    @endif
                                    @error('last_visit')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-outline mt-2 mb-1">
                                    <label class="form-label" for="next_visit">Próxima visita al colmenar</label>
                                    @if ($apiary->next_visit === null)
                                        <input class="form-control form-control-lg" type="date" name="next_visit"
                                            id="next_visit">
                                    @else
                                        <input class="form-control form-control-lg" type="date" name="next_visit"
                                            id="next_visit"
                                            value="{{ old('next_visit', date('Y-m-d', strtotime($apiary->next_visit))) }}">
                                    @endif
                                    @error('next_visit')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <h4 class="h4 mt-4">Tareas próxima visita</h4>

                                <div class="form-outline mt-2 mb-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            {{ old('collect_honey', $apiary->collect_honey === 1 ? 'checked' : '') }}
                                            id="collect_honey" name="collect_honey">
                                        <label class="form-check-label" for="collect_honey">
                                            Recolectar Miel
                                        </label>
                                    </div>
                                </div>

                                <div class="form-outline mt-2 mb-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            {{ old('collect_pollen', $apiary->collect_pollen === 1 ? 'checked' : '') }}
                                            id="collect_pollen" name="collect_pollen">
                                        <label class="form-check-label" for="collect_pollen">
                                            Recolectar Polen
                                        </label>
                                    </div>
                                </div>

                                <div class="form-outline mt-2 mb-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            {{ old('collect_apitoxine', $apiary->collect_apitoxine === 1 ? 'checked' : '') }}
                                            id="collect_apitoxine" name="collect_apitoxine">
                                        <label class="form-check-label" for="collect_apitoxine">
                                            Recolectar Apitoxina
                                        </label>
                                    </div>
                                </div>

                                <div class="form-outline mt-2 mb-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            {{ old('refill_water', $apiary->refill_water === 1 ? 'checked' : '') }}
                                            id="refill_water" name="refill_water">
                                        <label class="form-check-label" for="refill_water">
                                            Rellenar depósitos de agua
                                        </label>
                                    </div>
                                </div>

                                <div class="form-outline mt-2 mb-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            {{ old('clear_apiary', $apiary->clear_apiary === 1 ? 'checked' : '') }}
                                            id="clear_apiary" name="clear_apiary">
                                        <label class="form-check-label" for="clear_apiary">
                                            Tareas de limpieza y desbrozado
                                        </label>
                                    </div>
                                </div>

                                <div class="form-outline mt-3 mb-1">
                                    <div class="form-floating">
                                        <textarea name="others" class="form-control" placeholder="Leave a comment here" id="others" style="height: 150px">{{ old('others', $apiary->others) }}</textarea>
                                        <label for="others">Otras y/o anotaciones</label>
                                        @if($errors->has('others'))
                                            <p class="text-danger">{{ $errors->first('others') }}</p>
                                        @endif
                                    </div>
                                </div>
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
