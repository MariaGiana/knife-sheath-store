 
   @extends('layouts.app')
   @section('content')
            <div class="container mt-2 pt-2">
                <div class="row align-items-center">
                    <div class="col-lg-12 text-center">
                        <div class="border-text">
                            <div class="text_overlay"><h3>Nuestros Productos</h3></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                @foreach($products as $product)
                    <div class="col-6 col-md-3 mt-4 text-center">
                        <div class="card h-100 border-light shadow-sm"> 
                            
                            <div class="p-3" style="height: 180px; display: flex; align-items: center; justify-content: center;">
                                @if($product->fotos && $product->fotos->foto1)
                                    <img src="{{ asset($product->fotos->foto1) }}" alt="{{ $product->name }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                @else
                                    <span class="text-muted small">Sin imagen</span>
                                @endif
                            </div>

                            <div class="card-body p-2">
                                <h6 class="card-title text-dark fw-bold mb-1">{{ $product->name }}</h6>
                                <p class="text-success m-0 fw-bold">
                                    $ {{ number_format($product->precio, 0, '', '.') }}
                                </p>
                            </div>
                            
                            <div class="card-footer bg-transparent border-0 p-2">
                                <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#modal-{{ $product->id }}">
                                    Ver más
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modal-{{ $product->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content text-start">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">{{ $product->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    
                                    <div id="carousel-{{ $product->id }}" class="carousel slide bg-light mb-3" data-bs-ride="carousel">
                                        <div class="carousel-inner text-center" style="height: 250px;">
                                            @if($product->fotos)
                                                @if($product->fotos->foto1)
                                                    <div class="carousel-item active h-100">
                                                        <img src="{{ asset($product->fotos->foto1) }}" class="d-inline-block h-100" style="object-fit: contain;" alt="Foto 1">
                                                    </div>
                                                @endif
                                                @if($product->fotos->foto2)
                                                    <div class="carousel-item h-100">
                                                        <img src="{{ asset($product->fotos->foto2) }}" class="d-inline-block h-100" style="object-fit: contain;" alt="Foto 2">
                                                    </div>
                                                @endif
                                                @if($product->fotos->foto3)
                                                    <div class="carousel-item h-100">
                                                        <img src="{{ asset($product->fotos->foto3) }}" class="d-inline-block h-100" style="object-fit: contain;" alt="Foto 3">
                                                    </div>
                                                @endif
                                            @else
                                                <div class="carousel-item active pt-5">
                                                    <span class="text-muted">No hay fotos disponibles</span>
                                                </div>
                                            @endif
                                        </div>
                                        @if($product->fotos && ($product->fotos->foto2 || $product->fotos->foto3))
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $product->id }}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $product->id }}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                                            </button>
                                        @endif
                                    </div>

                                    <h4 class="text-success fw-bold">$ {{ number_format($product->precio, 0, '', '.') }}</h4>
                                    
                                    <p class="mt-3 mb-1 fw-bold text-secondary">Descripción:</p>
                                    <p class="text-muted small">
                                        {{ $product->description_product ?? 'Este artesano no ha añadido una descripción todavía.' }}
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-block mt-2" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
    @csrf 
    
    <button type="submit" class="btn btn-primary btn-block mt-2">
        <i class="bi bi-cart-plus"></i> Agregar al Carrito
    </button>
</form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection