@extends('layouts.app')

@section('content')
    <section class="container" style="margin-bottom: 110px">
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-4">

                        @if ($path === 'diseases.update')
                            <h3 class="text-uppercase text-center mb-1">Editar Enfermedad</h3>
                        @else
                            <h3 class="text-uppercase text-center mb-1">Registrar Enfermedad</h3>
                        @endif

                        <form action="{{ route($path, $disease) }}" method="POST">
                            @csrf

                            @if ($path === 'diseases.update')
                                @method('PATCH')
                            @endif

                            <div class="form-outline mb-1">
                                <label class="form-label" for="name"></label>
                                <select class="form-select form-select-lg" name="name" id="name">
                                    @foreach ($diseasesOptions as $diseaseOption)
                                        <option value="{{ $diseaseOption }}" {{ old('name', $disease->name) == $diseaseOption ? 'selected' : '' }}>{{ $diseaseOption }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-outline mb-1">
                                <label class="form-label" for="treatment_start_date">Fecha inicio tratamiento</label>
                                @if($disease->treatment_start_date === null)
                                <input class="form-control form-control-lg" type="date" name="treatment_start_date" id="treatment_start_date">
                                @else
                                <input class="form-control form-control-lg" type="date" name="treatment_start_date" id="treatment_start_date" value="{{ old('treatment_start_date', date('Y-m-d', strtotime($disease->treatment_start_date))) }}">
                                @endif
                                @error('treatment_start_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-outline mb-1">
                                <label class="form-label" for="treatment_repeat_date">Repetir tratamiento en</label>
                                <select class="form-select form-select-lg" name="treatment_repeat_date" id="treatment_repeat_date">
                                        <option value="7">7 días</option>
                                        <option value="15">15 días</option>
                                        <option value="30">30 días</option>
                                </select>
                            </div>

                            <input type="text" name="beehive_id" value="{{ $beehive }}" hidden>

                            <div class="d-flex justify-content-evenly mt-4">

                                @if ($path === 'diseases.update')
                                    <button type="submit"
                                        class="btn btn-primary btn-block  gradient-custom text-white">Editar</button>
                                @else
                                    <button type="submit"
                                        class="btn btn-primary btn-block  gradient-custom text-white">Añadir</button>
                                @endif

                                <a href="{{ route('beehives.show', $beehive) }}"
                                    class="btn btn-danger btn-block  gradient-custom text-white">Cancelar</a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
