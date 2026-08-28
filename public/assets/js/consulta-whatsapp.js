/**
 * Lógica para el envío de consultas rápidas a WhatsApp
 * Módulo aislado para mantener buenas prácticas y separación de responsabilidades.
 */
document.addEventListener('DOMContentLoaded', function () {
    const botonEnviar = document.getElementById('btn-enviar-consulta-wa');

    if (botonEnviar) {
        botonEnviar.addEventListener('click', function () {
            const telefonoTaller = "4552616403"; 

            const inputNombre = document.getElementById('whatsapp-nombre');
            const inputMensaje = document.getElementById('whatsapp-mensaje');

            if (!inputNombre || !inputMensaje) return;

            const nombre = inputNombre.value.trim();
            const mensaje = inputMensaje.value.trim();

            if (nombre === "" || mensaje === "") {
                alert("Por favor, completa tu nombre y tu consulta antes de enviar.");
                return;
            }

            const textoMensaje = `¡Hola! Me llamo ${nombre} y tengo una consulta desde la web de Vainas Artesanales:\n\n"${mensaje}"`;
            const textoUrl = encodeURIComponent(textoMensaje);

            // 1. Abrimos WhatsApp en otra pestaña
            const urlWhatsApp = `https://api.whatsapp.com/send?phone=${telefonoTaller}&text=${textoUrl}`;
            window.open(urlWhatsApp, '_blank');

            // 2. Cerramos el modal y limpiamos el DOM
            const modalElement = document.getElementById('modalConsultaWhatsApp');
            if (modalElement) {
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                if (modalInstance) {
                    modalInstance.hide();
                    
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) backdrop.remove();
                    
                    document.body.classList.remove('modal-open');
                    document.body.style.overflow = 'auto';
                    document.documentElement.style.overflow = 'auto';
                    document.body.style.paddingRight = '0px';
                }
            }

            // 3. Limpiamos los campos
            inputNombre.value = "";
            inputMensaje.value = "";

            // 4. Mostramos una notificación flotante de éxito en tu web
            mostrarNotificacionWhatsApp();
        });
    }
});

/**
 * Función auxiliar para mostrar un cartelito temporal de aviso en pantalla
 */
function mostrarNotificacionWhatsApp() {
    // Creamos el elemento div para la alerta flotante
    const alerta = document.createElement('div');
    alerta.innerHTML = `
        <div style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; background-color: #198754; color: white; padding: 12px 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.2); font-family: sans-serif; font-size: 0.9rem; display: flex; align-items: center; gap: 10px;">
            <i class="bi bi-whatsapp" style="font-size: 1.2rem;"></i>
            <span>¡Se abrió WhatsApp! Solo dale a <strong>Enviar</strong> en la app para completar tu consulta.</span>
        </div>
    `;
    
    document.body.appendChild(alerta);

    // Hacemos que la alerta desaparezca sola después de 5 segundos
    setTimeout(() => {
        alerta.remove();
    }, 5000);
}