/**
 * public/assets/js/pedido-whatsapp.js
 * Procesa el formulario del carrito y envía el pedido estructurado por WhatsApp.
 */
document.addEventListener('DOMContentLoaded', function () {
    const formPedido = document.getElementById('form-pedido-whatsapp');

    if (formPedido) {
        formPedido.addEventListener('submit', function (e) {
            e.preventDefault(); // Evitamos que la página se recargue de forma nativa

            const telefonoTaller = "4552616403"; 

            // 2. Capturamos los datos del formulario de envío
            const nombre = document.getElementById('cliente-nombre').value.trim();
            const telefono = document.getElementById('cliente-telefono').value.trim();
            const direccion = document.getElementById('cliente-direccion').value.trim();
            const notas = document.getElementById('cliente-notes') || document.getElementById('cliente-notas');
            const notasTexto = notas ? notas.value.trim() : "";

            // 3. Recorremos las filas de la tabla para armar el remito dinámicamente
            // Buscamos las filas de datos comunes en una tabla
            const filasProductos = document.querySelectorAll('table tbody tr');
            
            if (filasProductos.length === 0) {
                alert("Tu carrito parece estar vacío.");
                return;
            }

            let detalleProductos = "";

            filasProductos.forEach(fila => {
                // Buscamos el nombre (puede ser por clase .producto-nombre o la primera celda)
                const celdaNombre = fila.querySelector('.producto-nombre') || fila.cells[0];
                // Buscamos el input de cantidad
                const inputCantidad = fila.querySelector('.input-cantidad-directa') || fila.querySelector('input[type="number"]');
                // Buscamos el subtotal de esa fila
                const celdaSubtotal = fila.querySelector('.td-subtotal') || fila.querySelector('.producto-subtotal') || fila.cells[fila.cells.length - 1];

                if (celdaNombre && inputCantidad) {
                    const nombreProd = celdaNombre.textContent.trim();
                    const cantidad = inputCantidad.value;
                    const subtotal = celdaSubtotal ? celdaSubtotal.textContent.trim() : "";

                    // Vamos acumulando las líneas con formato de WhatsApp
                    detalleProductos += `*• ${cantidad}x* ${nombreProd} (${subtotal})\n`;
                }
            });

            // Capturamos el Total General del carrito
            const elementoTotal = document.getElementById('total-general-carrito') || document.getElementById('cart-total-general') || document.querySelector('.total-general');
            const totalTexto = elementoTotal ? elementoTotal.textContent.trim() : "$ 0";

            // 4. Construimos el mensaje de texto premium
            let mensajeWhatsApp = `📦 *NUEVO PEDIDO - VAINAS ARTESANALES*\n\n`;
            mensajeWhatsApp += `👤 *Cliente:* ${nombre}\n`;
            mensajeWhatsApp += `📞 *Teléfono:* ${telefono}\n`;
            mensajeWhatsApp += `📍 *Dirección:* ${direccion}\n`;
            
            if (notasTexto !== "") {
                mensajeWhatsApp += `📝 *Notas:* _${notasTexto}_\n`;
            }
            
            mensajeWhatsApp += `\n🛒 *DETALLE DEL PEDIDO:*\n`;
            mensajeWhatsApp += detalleProductos;
            mensajeWhatsApp += `\n💰 *TOTAL A PAGAR:* *${totalTexto}*\n\n`;
            mensajeWhatsApp += `_Hola! Acabo de armar mi pedido en la web. ¿Cómo coordinamos el pago y el envío?_`;

            // 5. Redirección limpia y segura
            const urlFinal = `https://api.whatsapp.com/send?phone=${telefonoTaller}&text=${encodeURIComponent(mensajeWhatsApp)}`;
            
            window.open(urlFinal, '_blank');

            // ==========================================================================
            // 6. TRABAJO LIMPIO: Vaciamos el carrito en la web después de enviar
            // ==========================================================================
            
            // A. Avisamos de forma silenciosa a Laravel que borre el carrito de la sesión
            // (Asumiendo que tu ruta de vaciar carrito se llama 'cart.clear' o similar)
           fetch(URL_VACIAR_CARRITO, { 
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (response.ok) {
            }
        })
        .catch(err => console.error("Error al vaciar sesión en servidor:", err));

            const contadorHeader = document.getElementById('checkout_items');
            if (contadorHeader) contadorHeader.textContent = '0';

            // Cerramos el formulario colapsable automáticamente para limpiar la pantalla
            const seccionForm = document.getElementById('seccionFormularioEnvio');
            if (seccionForm) {
                seccionForm.classList.remove('show');
            }

            // Reemplazamos la tabla por un mensaje elegante con tarjeta de fondo
const contenedorCarrito = document.querySelector('.container.my-5') || document.querySelector('main');
const mensajeExito = document.getElementById('html-mensaje-exito').innerHTML;
if (contenedorCarrito) {
  contenedorCarrito.innerHTML = mensajeExito;
    
    // Programamos el botón dinámicamente
    document.getElementById('btn-volver-tienda').addEventListener('click', function(e) {
        e.preventDefault();
        window.location.href = URL_HOME;
    });

}
        });
    }
});