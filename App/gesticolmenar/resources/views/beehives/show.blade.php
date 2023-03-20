@extends('layouts.app')

@section('content')
    @php
        $honeyId = null;
        $pollenId = null;
        $apitoxineId = null;
    @endphp
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
                <div class="col col-lg-10 mb-4 mb-lg-0">
                    <div class="card p-5 mb-3 beehive-card" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-2 gradient-custom text-center"
                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <i class="bi bi-archive" style="font-size: 4rem; color: #461400"></i>
                                <h5 class="text-black mb-4 mt-2">Código: {{ $beehive->user_code }}</h5>
                                <a href="{{ route('beehives.edit', $beehive) }}" class="btn btn-success"><i
                                        class="bi bi-pencil"></i></a>
                            </div>

                            {{-- Data column --}}
                            <div class="col-md-3">
                                <div class="card-body p-4 .beehive-card">
                                    <h6 class="text-center">Información</h6>
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

                            {{-- Products column --}}
                            <div class="col-md-3">
                                <div class="card-body p-4 .beehive-card">
                                    <h6 class="text-center">Productos</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        @foreach ($products as $product)
                                            <div class="col-12">
                                                <h6>{{ $product->type }}</h6>
                                                @if ($product->type === 'Miel')
                                                    @php
                                                        $honeyId = $product->id;
                                                        $honeyQuantity = $product->grams;
                                                    @endphp
                                                    <div class="text-muted d-flex justify-content-between mb-3">
                                                        <p class="product-quantity"> {{ $product->grams / 1000 }} kg </p>
                                                        <p> <button data-bs-toggle="modal"
                                                                data-bs-target="#modalEditProductHoney"
                                                                class="btn btn-primary"><i
                                                                    class="bi bi-pencil"></i></button></p>
                                                        <form action="{{ route('products.destroy', $product) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"><i
                                                                    class="bi bi-trash3"></i></button>
                                                        </form>
                                                    </div>
                                                @elseif($product->type === 'Polen')
                                                    @php
                                                        $pollenId = $product->id;
                                                        $pollenQuantity = $product->grams;
                                                    @endphp
                                                    <div class="text-muted d-flex justify-content-between mb-3">
                                                        <p class="product-quantity"> {{ $product->grams / 1000 }} kg </p>
                                                        <p> <button data-bs-toggle="modal"
                                                                data-bs-target="#modalEditProductPollen"
                                                                class="btn btn-primary"><i
                                                                    class="bi bi-pencil"></i></button></p>

                                                        <form action="{{ route('products.destroy', $product) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"><i
                                                                    class="bi bi-trash3"></i></button>
                                                        </form>
                                                    </div>
                                                @else
                                                    @php
                                                        $apitoxineId = $product->id;
                                                        $apitoxineQuantity = $product->grams;
                                                    @endphp
                                                    <div class="text-muted d-flex justify-content-between mb-3">

                                                        <p class="product-quantity">{{ $product->grams }} grs </p>
                                                        <p><button data-bs-toggle="modal"
                                                                data-bs-target="#modalEditProductApitoxine"
                                                                class="btn btn-primary"><i
                                                                    class="bi bi-pencil"></i></button>


                                                        <form action="{{ route('products.destroy', $product) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"><i
                                                                    class="bi bi-trash3"></i></button>
                                                        </form>

                                                    </div>
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

                            {{-- Disesases Column --}}
                            <div class="col-md-3">
                                <div class="card-body p-4 .beehive-card">
                                    <h6 class="text-center">Enfermedades</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        @foreach ($diseases as $disease)
                                            <h6>{{ $disease->name }}</h6>
                                            <div class="col-12 d-flex justify-content-between mb-3">
                                                <p class="text-muted">Tratar:
                                                    {{ date('d-m-Y', strtotime($disease->treatment_repeat_date)) }}</p>
                                                <p><a href="{{ route('diseases.edit', $disease) }}"
                                                        class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                                                <form action="{{ route('diseases.destroy', $disease) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="bi bi-trash3"></i></button>
                                                </form>
                                            </div>
                                        @endforeach
                                        <div class="col-12">
                                            <a type="button" class="btn btn-primary"
                                                href="{{ route('diseases.addDiseaseToBeehive', $beehive) }}">Registrar
                                                Enfermedad</a>
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
    <div class="modal fade" id="modalAddProduct" tabindex="-1" aria-labelledby="modalAddProductLabel"
        aria-hidden="true">
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

                            <div class="form-outline mb-4">
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


    <!-- Modal Edit Product Honey-->
    @if ($honeyId != null)
        <div class="modal fade" id="modalEditProductHoney" tabindex="-1" aria-labelledby="modalEditProductLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditProductLabel">Editar cantidad Miel</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('products.update', $honeyId) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-outline mb-4">
                                <label class="form-label" for="grams">Cantidad en gramos</label>
                                <input type="number" min="0" id="grams" name="grams"
                                    class="form-control form-control-lg" value="{{ old('grams', $honeyQuantity) }}" />
                                @if ($errors->has('grams'))
                                    <p class="text-danger">{{ $errors->first('grams') }}</p>
                                @endif
                            </div>
                            <input type="text" name="beehive_id" value="{{ $beehive->id }}" hidden>
                            <input type="text" name="type" value="Miel" hidden>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </form>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>

                </div>
            </div>
        </div>
    @endif

    <!-- Modal Edit Product Pollen-->
    @if ($pollenId != null)
        <div class="modal fade" id="modalEditProductPollen" tabindex="-1" aria-labelledby="modalEditProductLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditProductLabel">Editar cantidad Polen</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('products.update', $pollenId) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-outline mb-4">
                                <label class="form-label" for="grams">Cantidad en gramos</label>
                                <input type="number" min="0" id="grams" name="grams"
                                    class="form-control form-control-lg" value="{{ old('grams', $pollenQuantity) }}" />
                                @if ($errors->has('grams'))
                                    <p class="text-danger">{{ $errors->first('grams') }}</p>
                                @endif
                            </div>
                            <input type="text" name="beehive_id" value="{{ $beehive->id }}" hidden>
                            <input type="text" name="type" value="Polen" hidden>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </form>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>

                </div>
            </div>
        </div>
    @endif

    <!-- Modal Edit Product Apitoxine-->
    @if ($apitoxineId != null)
        <div class="modal fade" id="modalEditProductApitoxine" tabindex="-1" aria-labelledby="modalEditProductLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditProductLabel">Editar cantidad Apitoxina</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('products.update', $apitoxineId) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-outline mb-4">
                                <label class="form-label" for="grams">Cantidad en gramos</label>
                                <input type="number" min="0" id="grams" name="grams"
                                    class="form-control form-control-lg"
                                    value="{{ old('grams', $apitoxineQuantity) }}" />
                                @if ($errors->has('grams'))
                                    <p class="text-danger">{{ $errors->first('grams') }}</p>
                                @endif
                            </div>
                            <input type="text" name="beehive_id" value="{{ $beehive->id }}" hidden>
                            <input type="text" name="type" value="Apitoxina" hidden>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </form>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                    
                </div>
            </div>
        </div>
    @endif
@endsection
