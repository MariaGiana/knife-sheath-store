 <div class="modal fade" id="modalConsultaWhatsApp" tabindex="-1" aria-labelledby="modalConsultaWhatsAppLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm-custom">
            <div class="modal-content" style="background-color: var(--color-fondo-crema); color: var(--color-texto-oscuro); border-radius: 12px; border: 1px solid rgba(51,51,59,0.1);">
                
                <div class="modal-header" style="border-bottom: 1px solid rgba(51,51,59,0.1);">
                    <h5 class="modal-title fw-bold" id="modalConsultaWhatsAppLabel" style="font-family: 'Playfair Display', serif; font-size: 1.2rem;">
                        <i class="bi bi-whatsapp text-success me-1"></i> Consultas al Taller
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <p class="small text-muted mb-3">Escribí tu nombre y tu duda. Te responderemos directo a tu WhatsApp.</p>
                    
                    <div class="mb-3">
                        <label for="whatsapp-nombre" class="form-label small fw-bold mb-1">Tu Nombre:</label>
                        <input type="text" id="whatsapp-nombre" class="form-control" style="background-color: #ffffff; border: 1px solid rgba(51,51,59,0.2); color: var(--color-texto-oscuro); font-size: 0.9rem;" placeholder="Ej: Juan Pérez">
                    </div>
                    <div class="mb-3">
                        <label for="whatsapp-mensaje" class="form-label small fw-bold mb-1">¿Cuál es tu consulta?:</label>
                        <textarea id="whatsapp-mensaje" class="form-control" rows="3" style="background-color: #ffffff; border: 1px solid rgba(51,51,59,0.2); color: var(--color-texto-oscuro); font-size: 0.9rem;" placeholder="Ej: ¿Hacen vainas a medida para cuchillos de 20cm?"></textarea>
                    </div>
                </div>
                
                <div class="modal-footer" style="border-top: 1px solid rgba(51,51,59,0.1);">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-custom-artesanal btn-sm" id="btn-enviar-consulta-wa">
                        Enviar a WhatsApp
                    </button>
                </div>

            </div>
        </div>
    </div>