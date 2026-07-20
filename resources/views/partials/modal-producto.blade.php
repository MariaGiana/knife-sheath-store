<div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Contenedor del Carrusel -->
                <div id="productCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                    <div class="carousel-inner" id="carousel-inner"></div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-dark rounded-circle"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-dark rounded-circle"></span>
                    </button>
                </div>

                <p id="modal-desc"></p>
                <p class="fw-bold">Precio: $ <span id="modal-price"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <!-- Formulario -->
                <form id="modal-form-cart" method="POST">
                    @csrf
                   <button type="submit" class="btn btn-custom-artesanal mt-2">
                        <i class="bi bi-cart-plus"></i> Agregar al Carrito
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>