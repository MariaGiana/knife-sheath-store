@extends('layouts.app')

@section('content')
<div class="hero-artesanal">
    <div class="hero-content">
        <h1>Vainas Artesanales</h1>
        <p>Calidad, resistencia y terminaciones únicas</p>
    </div>
</div>

<div class="container my-5">
    <!-- GRILLA DE PRODUCTOS (Limpia de modales) -->
    <div class="row">
        @foreach($products as $product)
            <div class="col-6 col-md-3 mt-4 text-center">
                <div class="card h-100 border-0 shadow-sm product-card-artesanal"> 
                    
                    <div class="p-3 product-img-container" style="height: 180px; display: flex; align-items: center; justify-content: center;">
                        @if($product->fotos && $product->fotos->foto1)
                            <img src="{{ asset($product->fotos->foto1) }}" alt="{{ $product->name }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                        @else
                            <span class="text-muted small">Sin imagen</span>
                        @endif
                    </div>

                    <div class="card-body p-2 product-body-artesanal">
                        <h6 class="card-title product-title-artesanal mb-1" style="font-size: 1rem;">{{ $product->name }}</h6>
                        <p class="product-price-artesanal m-0" style="font-size: 1.15rem;">
                            $ {{ number_format($product->precio, 0, '', '.') }}
                        </p>
                    </div>
                    
                    <div class="card-footer bg-transparent border-0 p-2">
                        <button type="button" class="btn btn-custom-artesanal btn-sm w-100" data-bs-toggle="modal" data-bs-target="#modal-{{ $product->id }}">
                            Ver más
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- SECCIÓN PERIFÉRICA: Renderizamos los modales abajo del todo, fuera de la estructura de la grilla -->
@foreach($products as $product)
    @include('partials.modal-producto')
@endforeach

@endsection