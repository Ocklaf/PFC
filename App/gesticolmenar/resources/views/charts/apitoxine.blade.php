@extends('layouts.app')

@section('content')

    <div id="app">

        <div class="container-fluid">
            <h1 class="text-center p-3 mt-4 mb-4">Gramos de Apitoxina por Colmenar</h1>
            <div class="row">
                <div class="col-12">
                    <div class="card rounded">
                        <div class="card-body py-3 px-3">
                            {!! $apitoxineApiaryChart->container() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </main>
    </div>

    {{-- Chartscript --}}
    @if($apitoxineApiaryChart)
    {!! $apitoxineApiaryChart->script() !!}
    @endif

@endsection