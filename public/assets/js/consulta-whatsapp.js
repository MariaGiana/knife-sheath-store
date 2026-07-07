/**
 * Lógica para el envío de consultas rápidas a WhatsApp
 * Módulo aislado para mantener buenas prácticas y separación de responsabilidades.
 */
document.addEventListener('DOMContentLoaded', function () {
    const botonEnviar = document.getElementById('btn-enviar-consulta-wa');

    // Verificamos que el botón exista en la pantalla actual para no tirar errores en consola
    if (botonEnviar) {
        botonEnviar.addEventListener('click', function () {
            // 1. TU NÚMERO DE TELÉFONO (Configuralo acá, con código de país, sin espacios ni +)
            const telefonoTaller = "4552616403"; 

            // 2. Capturamos los elementos del DOM
            const inputNombre = document.getElementById('whatsapp-nombre');
            const inputMensaje = document.getElementById('whatsapp-mensaje');

            if (!inputNombre || !inputMensaje) return;

            const nombre = inputNombre.value.trim();
            const mensaje = inputMensaje.value.trim();

            // 3. Validación de campos vacíos
            if (nombre === "" || mensaje === "") {
                alert("Por favor, completa tu nombre y tu consulta antes de enviar.");
                return;
            }

            // 4. Estructuración y formateo del mensaje (Negritas en WhatsApp con asteriscos)
            const textoMensaje = `¡Hola! Me llamo ${nombre} y tengo una consulta desde la web de Vainas Artesanales:\n\n"${mensaje}"`;
            const textoUrl = encodeURIComponent(textoMensaje);

            // 5. Redirección segura
            const urlWhatsApp = `https://api.whatsapp.com/send?phone=${telefonoTaller}&text=${textoUrl}`;
            window.open(urlWhatsApp, '_blank');

          // 6. Cierre automático del modal y limpieza profunda del fondo (Adiós pantalla tildada)
            const modalElement = document.getElementById('modalConsultaWhatsApp');
            if (modalElement) {
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                if (modalInstance) {
                    modalInstance.hide();
                    
                    // Forzamos la eliminación de cualquier residuo de fondo oscuro que deje Bootstrap
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) {
                        backdrop.remove();
                    }
                    
                    // Le devolvemos el scroll y los clics al cuerpo de la página
                    document.body.classList.remove('modal-open');
                   document.body.style.overflow = 'auto';
                    document.documentElement.style.overflow = 'auto';
                    document.body.style.paddingRight = '0px';
                }
            }
        });
    }
});