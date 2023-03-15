@extends('layouts.app')

@section('content')
    <section class="container" style="margin-bottom: 110px">

        <div class="row d-flex justify-content-center mt-5">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        @if ($path === 'places.update')
                            <h3 class="text-uppercase text-center mb-1">Editar Ubicación</h3>
                        @else
                            <h3 class="text-uppercase text-center mb-1">Añadir Ubicación</h3>
                        @endif

                        <form action="{{ route($path, $place) }}" method="POST">
                            @csrf
                            @if ($path === 'places.update')
                                @method('PATCH')
                            @endif
                            <div class="form-outline mb-1">
                                <label class="form-label" for="name">Nombre</label>
                                <input type="text" id="name" name="name" class="form-control form-control-lg"
                                    value="{{ old('name', $place->name) }}" />
                                @if ($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif
                            </div>

                            <div class="form-outline mb-1">
                                <label class="form-label" for="catastral_code">Referencia catastral</label>
                                <input type="text" id="catastral_code" name="catastral_code"
                                    class="form-control form-control-lg"
                                    value="{{ old('catastral_code', $place->catastral_code) }}" />
                                @if ($errors->has('catastral_code'))
                                    <p class="text-danger">{{ $errors->first('catastral_code') }}</p>
                                @endif
                            </div>

                            <div class="form-outline mb-1">
                                <label class="form-label" for="poligon">Polígono</label>
                                <input type="number" min="1" step="1" id="poligon" name="poligon"
                                    class="form-control form-control-lg" value="{{ old('poligon', $place->poligon) }}" />
                                @if ($errors->has('poligon'))
                                    <p class="text-danger">{{ $errors->first('poligon') }}</p>
                                @endif
                            </div>

                            <div class="form-outline mb-1">
                                <label class="form-label" for="parcel">Parcela</label>
                                <input type="number" min="1" step="1" id="parcel" name="parcel"
                                    class="form-control form-control-lg" value="{{ old('parcel', $place->parcel) }}" />
                                @if ($errors->has('parcel'))
                                    <p class="text-danger">{{ $errors->first('parcel') }}</p>
                                @endif
                            </div>

                            <div class="form-outline mb-1">
                                <label class="form-label" for="postal_code">Código Postal</label>
                                <input type="text" id="postal_code" name="postal_code"
                                    class="form-control form-control-lg"
                                    value="{{ old('postal_code', $place->postal_code) }}" />
                                @if ($errors->has('postal_code'))
                                    <p class="text-danger">{{ $errors->first('postal_code') }}</p>
                                @endif
                            </div>

                            <div class="form-outline mt-2 mb-1">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{ old('has_water', $place->has_water === 1 ? 'checked' : '')}} id="has_water" name="has_water">
                                <label class="form-check-label" for="has_water">
                                  Existe acceso a agua
                                </label>
                              </div>
                            </div>


                            <div class="d-flex justify-content-evenly mt-4">
                                @if ($path === 'places.update')
                                    <button type="submit"
                                        class="btn btn-primary btn-block  gradient-custom text-white">Editar</button>
                                @else
                                    <button type="submit"
                                        class="btn btn-primary btn-block  gradient-custom text-white">Añadir</button>
                                @endif

                                <a href="{{ route('places.index') }}"
                                    class="btn btn-danger btn-block  gradient-custom text-white">Cancelar</a>
                            </div>





                        </form>

                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
