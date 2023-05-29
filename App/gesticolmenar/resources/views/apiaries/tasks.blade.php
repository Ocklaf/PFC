@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-5" style="margin-bottom: 110px">
        @if ($apiariesTasks->count())
            <div class="row ">
                <h2 class="text-center mb-4">Tareas pendientes</h2>
                @foreach ($apiariesTasks as $apiaryTask)
                    <div class="col d-flex justify-content-center mb-4">
                        <div class="card" style="width: 19rem;">
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between">{{ $apiaryTask->place_name }} <a
                                        href="{{ route('apiaries.edit', $apiaryTask->id) }}"
                                        class="btn btn-primary card-link"><i class="bi bi-pencil"></i></a></h5>
                                <h6 class="card-subtitle mb-2 text-muted">Próxima visita:
                                    {{ date('d-m-Y', strtotime($apiaryTask->next_visit)) }}</h6>
                                <hr>

                                <ul class="list-group mt-3 mb-3">
                                    @if ($apiaryTask->collect_honey)
                                        <li class="list-group-item">Recolectar Miel</li>
                                    @endif

                                    @if ($apiaryTask->collect_pollen)
                                        <li class="list-group-item">Recolectar Polen</li>
                                    @endif

                                    @if ($apiaryTask->collect_apitoxine)
                                        <li class="list-group-item">Recolectar Apitoxina</li>
                                    @endif

                                    @if ($apiaryTask->refill_water)
                                        <li class="list-group-item">Rellenar depósitos de agua</li>
                                    @endif

                                    @if ($apiaryTask->clear_apiary)
                                        <li class="list-group-item">Limpieza y desbrozado</li>
                                    @endif
                                </ul>
                                <h6>Anotaciones</h6>
                                <p class="card-text">{{ $apiaryTask->others }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($beehivesWithDiseases->count())
            <div class="row">
                <h2 class="text-center mb-4 mt-4">Colmenas en tratamiento</h2>
                @foreach ($beehivesWithDiseases as $beehiveWithDisease)
                    <div class="col d-flex justify-content-center mb-4">
                        <div class="card" style="width: 19rem;">
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between">Colmena: {{ $beehiveWithDisease->user_code }} <a
                                  href="{{ route('beehives.show', $beehiveWithDisease->id) }}"
                                  class="btn btn-primary card-link"><i class="bi bi-pencil"></i></a></h5>
                                <h6 class="card-subtitle mb-2 text-muted">Colmenar: {{ $beehiveWithDisease->place_name }} </h6>
                                <hr>
                                @foreach ($beehiveWithDisease->diseases as $disease)
                                    <h6 class="card-text mt-4 mb-3">{{ $disease->name }}</h6>
                                    <p class="card-text">Fecha tratamiento:
                                        {{ date('d-m-Y', strtotime($disease->treatment_start_date)) }}</p>
                                    <p class="card-text">Próximo tratamiento:
                                        {{ date('d-m-Y', strtotime($disease->treatment_repeat_date)) }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        @endif
    </div>
@endsection
