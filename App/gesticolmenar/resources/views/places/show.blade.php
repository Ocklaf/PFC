@extends('layouts.app')

@section('content')
    <div class="container-fluid py-5 h-100" style="margin-bottom: 110px">
        @if ($place->user_id === auth()->user()->id)
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-6 mb-4 mb-lg-0">
                    <div class="card p-5 mb-3 place-card" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center"
                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <i class="bi bi-geo-alt" style="font-size: 4rem; color: #461400"></i>
                                <h5 class="text-black mb-4 mt-2">{{ $place->name }}</h5>
                                <a href="{{ route('places.edit', $place) }}" class="btn btn-success">Editar</a>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4 .place-card">
                                    <h6>Datos de la ubicacion</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-12">
                                            <h6>Referencia catastral</h6>
                                            <p class="text-muted">{{ $place->catastral_code }}</p>
                                        </div>
                                        <div class="col-12">
                                            <h6>Polígono</h6>
                                            <p class="text-muted">{{ $place->poligon }}</p>
                                        </div>
                                        <div class="col-12">
                                            <h6>Parcela</h6>
                                            <p class="text-muted">{{ $place->parcel }}</p>
                                        </div>
                                        <div class="col-12">
                                            <h6>Código Postal</h6>
                                            <p class="text-muted">{{ $place->postal_code }}</p>
                                        </div>
                                        <div class="col-12">
                                            <h6>Acceso a agua</h6>
                                            @if ($place->has_water)
                                                <p class="text-muted">Sí</p>
                                            @else
                                                <p class="text-muted">No</p>
                                            @endif
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
