@extends('layouts.app')

@section('content')
    <section class="container" style="margin-bottom: 110px">

        @if (!count($freeQueens))
            <div class="row d-flex justify-content-center mt-4">
                <div class="col-lg-6 col-md-8">
                    <div class="alert alert-danger text-center">
                        No existen Reinas disponibles, debes añadir una antes de añadir una colmena.
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="text-center">
                        <a href="" class="btn btn-primary">Añadir Reina</a>
                    </div>
                </div>
            </div>
        @endif

        <div class="row d-flex justify-content-center mt-5">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        @if ($path === 'beehives.update')
                            <h3 class="text-uppercase text-center mb-1">Editar Colmena</h3>
                        @else
                            <h3 class="text-uppercase text-center mb-1">Añadir Colmena</h3>
                        @endif

                        <form action="{{ route($path, $beehive) }}" method="POST">
                            @csrf
                            @if ($path === 'beehives.update')
                                @method('PATCH')
                            @endif

                            <div class="form-outline mb-1">
                                <label class="form-label" for="honey_frames">Código</label>
                                <input type="text" id="user_code" name="user_code" class="form-control form-control-lg"
                                        value="{{ old('user_code', $beehive->user_code) }}" />
                                    @if ($errors->has('user_code'))
                                        <p class="text-danger">{{ $errors->first('user_code') }}</p>
                                    @endif
                            </div>

                            <div class="form-outline mb-1">
                                <label class="form-label" for="type">Tipo de colmena</label>
                                <select class="form-select form-select-lg" name="type" id="type" name="type">
                                    <option value="Langstroth">Langstroth</option>
                                    <option value="Dadant">Dadant</option>
                                    <option value="Layens">Layens</option>
                                </select>
                            </div>



                            <div class="form-outline mb-1">
                                <label class="form-label" for="honey_frames">Cantidad de cuadros de Miel</label>
                                <input type="number" min="0" max="10" step="1" id="honey_frames" name="honey_frames"
                                    class="form-control form-control-lg"
                                    value="{{ old('honey_frames', $beehive->honey_frames) }}" />
                                @if ($errors->has('honey_frames'))
                                    <p class="text-danger">{{ $errors->first('honey_frames') }}</p>
                                @endif
                            </div>

                            <div class="form-outline mb-1">
                                <label class="form-label" for="pollen_frames">Cantidad de cuadros de Polen</label>
                                <input type="number" min="0" max="10" step="1" id="pollen_frames" name="pollen_frames"
                                    class="form-control form-control-lg"
                                    value="{{ old('pollen_frames', $beehive->pollen_frames) }}" />
                                @if ($errors->has('pollen_frames'))
                                    <p class="text-danger">{{ $errors->first('pollen_frames') }}</p>
                                @endif
                            </div>

                            <div class="form-outline mb-1">
                                <label class="form-label" for="brood_frames">Cantidad de cuadros de cría</label>
                                <input type="number" min="0" max="10" step="1" id="brood_frames" name="brood_frames"
                                    class="form-control form-control-lg"
                                    value="{{ old('brood_frames', $beehive->brood_frames) }}" />
                                @if ($errors->has('brood_frames'))
                                    <p class="text-danger">{{ $errors->first('brood_frames') }}</p>
                                @endif
                            </div>

                            <input type="text" name="apiary_id" value="{{$apiary}}" hidden>


                            @if (count($freeQueens))
                            <label class="form-label" for="type">Reina</label>
                                <select class="form-select form-select-lg" name="queen_id" id="queen_id">
                                    @foreach ($freeQueens as $queen)
                                        <option value="{{ $queen->id }}">Raza: {{ $queen->race}} - Color:{{$queen->color }}</option>
                                    @endforeach
                                </select>
                            @endif


                            @if (count($freeQueens))
                                <div class="d-flex justify-content-evenly mt-4">
                                    @if ($path === 'beehives.update')
                                    <button type="submit"
                                        class="btn btn-primary btn-block  gradient-custom text-white">Editar</button>
                                    @else
                                    <button type="submit"
                                        class="btn btn-primary btn-block  gradient-custom text-white">Añadir</button>
                                    @endif

                                    <a href="{{ route('login') }}"
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
