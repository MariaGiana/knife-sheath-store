<!-- resources/views/partials/modal-producto.blade.php -->
<div class="modal fade" id="modal-{{ $product->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-start" style="background-color: var(--color-fondo-crema); color: var(--color-texto-oscuro);">
            <div class="modal-header" style="border-bottom: 1px solid rgba(51,51,59,0.1);">
                <h5 class="modal-title fw-bold" style="font-family: 'Playfair Display', serif;">{{ $product->name }}</h5>
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

                <h4 class="fw-bold" style="color: var(--color-texto-oscuro); font-family: 'Poppins', sans-serif;">$ {{ number_format($product->precio, 0, '', '.') }}</h4>
                
                <p class="mt-3 mb-1 fw-bold text-secondary">Descripción:</p>
                <p class="text-muted small">
                    {{ $product->description_product ?? 'Este artesano no ha añadido una descripción todavía.' }}
                </p>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(51,51,59,0.1);">
                <button type="button" class="btn btn-secondary mt-2" data-bs-dismiss="modal">Cerrar</button>
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="form-agregar-carrito">
                    @csrf 
                    <button type="submit" class="btn btn-custom-artesanal mt-2">
                        <i class="bi bi-cart-plus"></i> Agregar al Carrito
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>