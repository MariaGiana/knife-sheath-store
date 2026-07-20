@extends('layouts.app')

@section('content')

<div class="hero-artesanal">
    <div class="hero-content">
        <h1>Vainas Artesanales</h1>
        <p>Calidad, resistencia y terminaciones únicas</p>
    </div>
</div>

<div class="container my-5" 
     x-data="{ 
        productos: [],
        abrirModal(product) {
            document.getElementById('modal-title').innerText = product.name;
            document.getElementById('modal-desc').innerText = product.description_product || 'Sin descripción';
            document.getElementById('modal-price').innerText = new Intl.NumberFormat('de-DE').format(product.precio);
            
            // Actualizar formulario
            document.getElementById('modal-form-cart').action = '{{ url('/cart/add') }}/' + product.id;

            // Construir carrusel
            const inner = document.getElementById('carousel-inner');
            inner.innerHTML = '';
            const fotos = [product.fotos.foto1, product.fotos.foto2, product.fotos.foto3].filter(f => f);
            
            fotos.forEach((foto, i) => {
                inner.innerHTML += `
                    <div class='carousel-item ${i === 0 ? 'active' : ''}'>
                        <img src='{{ asset('storage') }}/${foto}' class='d-block w-100' style='height: 250px; object-fit: contain;'>
                    </div>`;
            });

            new bootstrap.Modal(document.getElementById('productModal')).show();
        }
     }" 
     x-init="fetch('{{ url('/api/productos') }}').then(res => res.json()).then(data => productos = data)">
    <div class="row">
        <template x-for="product in productos" :key="product.id">
            <div class="col-6 col-md-3 mt-4 text-center">
                <div class="card h-100 border-0 shadow-sm product-card-artesanal"> 
                    
                    <div class="p-3 product-img-container" style="height: 180px; display: flex; align-items: center; justify-content: center;">
                        <img :src="'{{ asset('storage') }}/' + product.fotos.foto1" 
                             :alt="product.name" 
                             style="max-height: 100%; max-width: 100%; object-fit: contain;">
                    </div>

                    <div class="card-body p-2 product-body-artesanal">
                        <h6 class="card-title" style="font-size: 1rem;" x-text="product.name"></h6>
                        <p style="font-size: 1.15rem;">
                            $ <span x-text="new Intl.NumberFormat('de-DE').format(product.precio)"></span>
                        </p>
                    </div>
                    
                    <div class="card-footer bg-transparent border-0 p-2">
                        <button type="button" class="btn btn-custom-artesanal btn-sm w-100" 
                                @click="abrirModal(product)">
                            Ver más
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>

<!-- Incluimos el modal único fuera del x-data -->
@include('partials.modal-producto')

@endsection