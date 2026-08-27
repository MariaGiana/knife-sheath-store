<div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Cargando...</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- FORMULARIO CONECTADO CON TU JS GLOBAL -->
            <form class="form-agregar-carrito" action="{{ route('cart.add', ['id' => 0]) }}" method="POST" id="form-modal-carrito">
                @csrf
                <div class="modal-body">
                    
                    <!-- Carrusel de fotos -->
                    <div id="productCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                        <div class="carousel-inner" id="carousel-inner"></div>
                    </div>

                    <p id="modal-desc" class="text-muted"></p>
                    <h4 class="text-primary fw-bold">$ <span id="modal-price">0</span></h4>
                    
                    <!-- Input con la cantidad (opcional) -->
                    <input type="hidden" name="quantity" value="1">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <!-- Al ser type="submit", carrito-ajax.js lo interceptará automáticamente -->
                    <button type="submit" class="btn btn-custom-artesanal">
                        Agregar al Carrito
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>