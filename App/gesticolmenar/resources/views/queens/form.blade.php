@extends('layouts.app')

@section('content')
    <section class="container" style="margin-bottom: 110px">

        <div class="row d-flex justify-content-center mt-5">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-4">

                        @if ($path === 'queens.update')
                            <h3 class="text-uppercase text-center mb-1">Editar Reina</h3>
                        @else
                            <h3 class="text-uppercase text-center mb-1">Añadir Reina</h3>
                        @endif

                        <form action="{{ route($path, $queen) }}" method="POST">
                            @csrf
                            @if ($path === 'queens.update')
                                @method('PATCH')
                            @endif

                            <div class="form-outline mb-1">
                                <label class="form-label" for="race">Raza</label>
                                <select class="form-select form-select-lg" name="race" id="race" name="race">
                                    @foreach ($races as $race)
                                        <option value="{{ $race }}"
                                            {{ old('race', $queen->race) == $race ? 'selected' : '' }}>{{ $race }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-outline mb-1">
                                <label class="form-label" for="color">Color</label>
                                <input type="text" id="color" name="color"
                                    class="form-control form-control-lg shadow-none input-disabled"
                                    value="{{ old('color', $queen->color) }}" readonly />
                                @if ($errors->has('color'))
                                    <p class="text-danger">{{ $errors->first('color') }}</p>
                                @endif
                            </div>

                            <div class="form-outline mb-1">
                                <label class="form-label" for="start_date">Año de incio</label>
                                <input type="text" id="start_date" name="start_date"
                                    class="form-control form-control-lg shadow-none input-disabled"
                                    value="{{ old('start_date', $queen->start_date) }}" readonly />
                                @if ($errors->has('start_date'))
                                    <p class="text-danger">{{ $errors->first('start_date') }}</p>
                                @endif
                            </div>

                            <div class="form-outline mb-1">
                                <label class="form-label" for="end_date">Año de cambio</label>
                                <input type="text" id="end_date" name="end_date"
                                    class="form-control form-control-lg shadow-none input-disabled"
                                    value="{{ old('end_date', $queen->end_date) }}" readonly />
                                @if ($errors->has('end_date'))
                                    <p class="text-danger">{{ $errors->first('end_date') }}</p>
                                @endif
                            </div>

                            <div class="d-flex justify-content-evenly mt-4">
                                @if ($path === 'queens.update')
                                    <button type="submit"
                                        class="btn btn-primary btn-block  gradient-custom text-white">Editar</button>
                                @else
                                    <button type="submit"
                                        class="btn btn-primary btn-block  gradient-custom text-white">Añadir</button>
                                @endif

                                <a href="{{ route('apiaries.index') }}"
                                    class="btn btn-danger btn-block  gradient-custom text-white">Cancelar</a>
                            </div>
                            
                        </form>

                    </div>
                </div>
            </div>
        </div>
        
    </section>
@endsection
