<div class="card mt-2 border-0 shadow-sm" style="background-color: var(--color-fondo-crema); color: var(--color-texto-oscuro); border-radius: 12px;">    <div class="card-body p-4">
        <h5 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif;">
            <i class="bi bi-person-lines-fill me-2"></i> Datos para el Envío
        </h5>
        
        <form id="form-pedido-whatsapp">
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <label for="cliente-nombre" class="form-label small fw-bold mb-1">Nombre y Apellido:</label>
                    <input type="text" id="cliente-nombre" class="form-control" style="background-color: #ffffff; border: 1px solid rgba(51,51,59,0.2);" placeholder="Ej: Juan Pérez">
                </div>
                
                <div class="col-12 col-md-6 mb-3">
                    <label for="cliente-telefono" class="form-label small fw-bold mb-1">Teléfono de Contacto:</label>
                    <input type="tel" id="cliente-telefono" class="form-control" style="background-color: #ffffff; border: 1px solid rgba(51,51,59,0.2);" placeholder="Ej: 1123456789">
                </div>
                
                <div class="col-12 mb-3">
                    <label for="cliente-direccion" class="form-label small fw-bold mb-1">Dirección Completa (Calle, Número, Localidad):</label>
                    <input type="text" id="cliente-direccion" class="form-control" style="background-color: #ffffff; border: 1px solid rgba(51,51,59,0.2);" placeholder="Ej: Av. Siempreviva 742, CABA">
                </div>

                <div class="col-12 mb-4">
                    <label for="cliente-notas" class="form-label small fw-bold mb-1">Notas especiales (Opcional):</label>
                    <textarea id="cliente-notas" class="form-control" rows="2" style="background-color: #ffffff; border: 1px solid rgba(51,51,59,0.2);" placeholder="Ej: Es para un regalo / Medidas especiales del cuchillo..."></textarea>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-custom-artesanal w-100 w-md-auto px-5 py-2 fw-bold">
                    <i class="bi bi-whatsapp me-2"></i> Enviar Pedido por WhatsApp
                </button>
            </div>
        </form>
    </div>
</div>