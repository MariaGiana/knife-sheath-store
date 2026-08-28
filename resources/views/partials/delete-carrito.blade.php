<!-- Modal Único de Eliminación del Carrito -->
<div class="modal fade" id="deleteCartModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Quitar del carrito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-muted" id="delete-modal-carrito">
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                
                <!-- Este form cambiará su acción dinámicamente con JS -->
                <form id="form-delete-cart" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Sí, quitar</button>
                </form>
            </div>
        </div>
    </div>
</div>