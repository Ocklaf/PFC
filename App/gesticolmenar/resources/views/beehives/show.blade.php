@extends('layouts.app')

@section('content')
    <div class="container-fluid py-5 h-100" style="margin-bottom: 100px">
        @if (session('success'))
            <div class="row  d-flex justify-content-center mt-1">
                <div class="alert alert-success text-center mb-3 col-6">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if ($beehive->user_id === auth()->user()->id)
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-8 mb-4 mb-lg-0">
                    <div class="card p-5 mb-3 beehive-card" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-2 gradient-custom text-center"
                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <i class="bi bi-archive" style="font-size: 4rem; color: #461400"></i>
                                <h5 class="text-black mb-4 mt-2">Código: {{ $beehive->user_code }}</h5>
                                <a href="{{ route('beehives.edit', $beehive) }}" class="btn btn-success">Editar</a>
                            </div>
                            <div class="col-md-5">
                                <div class="card-body p-4 .beehive-card">
                                    <h6>Datos de la colmena</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-12">
                                            <h6>Tipo de colmena</h6>
                                            <p class="text-muted">{{ $beehive->type }}</p>
                                        </div>
                                        <div class="col-12">
                                            <h6>Reina</h6>
                                            <p class="text-muted">{{ $queen->race }}</p>
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

                            <div class="col-md-5">
                                <div class="card-body p-4 .beehive-card">
                                    <h6>Producción de la colmena</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        @foreach ($products as $product)
                                            <div class="col-12">
                                                <h6>{{ $product->type }}</h6>
                                                @if ($product->type === 'Miel' || $product->type === 'Polen')
                                                    <p class="text-muted d-flex justify-content-between">
                                                        {{ $product->grams / 1000 }} kg <button data-bs-toggle="modal"
                                                        data-bs-target="#modalEditProduct" data-product-id="{{$product->id}}"
                                                            class="btn btn-primary"><i class="bi bi-pencil"></i></button></p>
                                                @else
                                                    <p class="text-muted  d-flex justify-content-between">
                                                        {{ $product->grams }} grs <button data-bs-toggle="modal"
                                                        data-bs-target="#modalEditProduct" data-product-id="{{$product->id}}"
                                                            class="btn btn-primary"><i class="bi bi-pencil"></i></button></p>
                                                @endif
                                            </div>
                                        @endforeach
                                        <div class="col-12">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modalAddProduct">
                                                Añadir Producto
                                            </button>
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
                    Error: No tienes permisos para ver esta colmena
                </div>
            </div>
        @endif
    </div>

    <!-- Modal Add Product -->
    <div class="modal fade" id="modalAddProduct" tabindex="-1" aria-labelledby="modalAddProductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAddProductLabel">Añadir Producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @php
                        $options = ['Miel', 'Polen', 'Apitoxina'];
                        $types = [];
                        foreach ($products as $product) {
                            array_push($types, $product->type);
                        }
                        $types = array_diff($options, $types);
                    @endphp
                    @if (count($types) > 0)
                        <form action="{{ route('products.store') }}" method="POST">
                            @csrf
                            <div class="form-outline mb-1">
                                <label class="form-label" for="type">Producto</label>
                                <select class="form-select form-select-lg" name="type" id="type">
                                    @foreach ($types as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-outline mb-1">
                                <label class="form-label" for="grams">Cantidad en gramos</label>
                                <input type="number" id="grams" name="grams" class="form-control form-control-lg"
                                    value="{{ old('grams') }}" />
                                @if ($errors->has('grams'))
                                    <p class="text-danger">{{ $errors->first('grams') }}</p>
                                @endif
                            </div>
                            <input type="text" name="beehive_id" value="{{ $beehive->id }}" hidden>
                            <button type="submit" class="btn btn-primary">Añadir</button>
                        </form>
                    @else
                        <p class="alert alert-danger text-center">
                            Esta colmena ya tiene todos los productos.
                        </p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>


        <!-- Modal Edit Product -->
        <div class="modal fade" id="modalEditProduct" tabindex="-1" aria-labelledby="modalEditProductLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditProductLabel">Añadir Producto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                       @dump($product->id)
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>


@endsection
