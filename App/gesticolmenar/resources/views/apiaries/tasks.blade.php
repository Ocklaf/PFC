@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-5" style="margin-bottom: 110px">
      <div class="row ">
          <h2 class="text-center mb-4">Tareas pendientes</h2>
          @foreach($apiariesTasks as $apiaryTask)
          <div class="col d-flex justify-content-center mb-4">
              <div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">{{$apiaryTask->place_name}}</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Vistar el: {{date('d-m-Y', strtotime($apiaryTask->next_visit))}}</h6>
                  <ul class="list-group mt-3 mb-3">
                    @if($apiaryTask->collect_honey)
                    <li class="list-group-item">Recolectar Miel</li>
                    @endif

                    @if($apiaryTask->collect_pollen)
                    <li class="list-group-item">Recolectar Polen</li>
                    @endif

                    @if($apiaryTask->collect_apitoxine)
                    <li class="list-group-item">Recolectar Apitoxina</li>
                    @endif

                    @if($apiaryTask->refill_water)
                    <li class="list-group-item">Rellenar depósitos de agua</li>
                    @endif

                    @if($apiaryTask->clear_apiary)
                    <li class="list-group-item">Limpieza y desbrozado</li>
                    @endif                    
                  </ul>
                  <h6>Otras</h6>
                  <p class="card-text mb-5">{{$apiaryTask->others}}</p>
                  <a class="position-absolute bottom-0 start-0 m-2" href="#" class="card-link">Card link</a>
                  <a class="position-absolute bottom-0 end-0 m-2" href="#" class="card-link">Another link</a>
                </div>
              </div>
            </div>
              @endforeach
        </div>

        <div class="row">
          <h5>Colmenas en tratamiento</h5>
          <div class="col">
            @foreach($beehivesWithDiseases as $beehiveWithDisease)
            <a href="{{ route('beehives.show', $beehiveWithDisease->id)}}">{{$beehiveWithDisease->user_code}}</a>
            @endforeach
          </div>
        </div>

    </div>
@endsection
