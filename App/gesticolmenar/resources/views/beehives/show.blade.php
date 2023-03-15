@extends('layouts.app')

@section('content')
    <div class="container-fluid py-5 h-100" style="margin-bottom: 110px">
        @if ($beehive->user_id === auth()->user()->id)
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-6 mb-4 mb-lg-0">
                    <div class="card p-5 mb-3 beehive-card" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center"
                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <i class="bi bi-archive" style="font-size: 4rem; color: #461400"></i>
                                <h5 class="text-black mb-4 mt-2">Código: {{ $beehive->user_code }}</h5>
                                <a href="{{ route('beehives.edit', $beehive) }}" class="btn btn-success">Editar</a>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4 .beehive-card">
                                    <h6>Datos de la colmena</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-12">
                                            <h6>Tipo de colmena</h6>
                                            <p class="text-muted">{{ $beehive->type }}</p>
                                        </div>
                                        <div class="col-12">
                                            <h6>Cuadros de Miel</h6>
                                            <p class="text-muted">{{ $beehive->honey_frames }}</p>
                                        </div>
                                        <div class="col-12">
                                            <h6>Cuadros de Polen</h6>
                                            <p class="text-muted">{{ $beehive->pollen_frames }}</p>
                                        </div>
                                        <div class="col-12">
                                            <h6>Cuadros de Cría</h6>
                                            <p class="text-muted">{{ $beehive->brood_frames }}</p>
                                        </div>
                                        <div class="col-12">
                                          <h6>Colmenar al que pertenece</h6>
                                          <p class="text-muted">{{ $beehive->place_name }}</p>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row  d-flex justify-content-center mt-5">
                <div class="alert alert-danger text-center mb-3 col-6">
                    Error: No tienes permisos para acceder a esta ubicación
                </div>
            </div>
        @endif
    </div>
@endsection
