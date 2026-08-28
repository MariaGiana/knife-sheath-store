<div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Cargando...</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- FORMULARIO CONECTADO AL JS GLOBAL -->
            <form class="form-agregar-carrito" action="{{ route('cart.add', ['id' => 0]) }}" method="POST" id="form-modal-carrito">
                @csrf
                <div class="modal-body">
                    
                    <!-- Carrusel de fotos -->
                    <div id="productCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                        <div class="carousel-inner" id="carousel-inner"></div>
                    </div>

                    <p id="modal-desc" class="text-muted"></p>
                    <h4 class="text-primary fw-bold">$ <span id="modal-price">0</span></h4>
                    
                                <!-- Botón Anterior y siguiente-->
                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(100%);"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(100%);"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-custom-artesanal">
                        Agregar al Carrito
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>