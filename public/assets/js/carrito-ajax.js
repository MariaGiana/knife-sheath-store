/**
 * public/assets/js/carrito-ajax.js
 * Sistema unificado para el manejo del carrito de compras vía AJAX.
 * Totalmente blindado con delegación de eventos.
 */
document.addEventListener('DOMContentLoaded', function () {
    
    // ==========================================================================
    // 1. CAPTURA GLOBAL DE SUBMITS (Evita recargos y duplicaciones de clicks)
    // ==========================================================================
    document.addEventListener('submit', function (e) {
        
        // --- CASO A: BOTÓN "AGREGAR AL CARRITO" (Desde Tienda o Modales) ---
        const formAgregar = e.target.closest('.form-agregar-carrito');
        if (formAgregar) {
            e.preventDefault(); 
            e.stopImmediatePropagation();

            const boton = formAgregar.querySelector('button[type="submit"]');
            if (!boton) return;

            // Escudo anti doble click rápido
            if (boton.disabled || boton.classList.contains('procesando')) return;

            boton.disabled = true;
            boton.classList.add('procesando');

            const url = formAgregar.action;
            const formData = new FormData(formAgregar);
            const textoOriginal = boton.innerHTML;

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const contadorHeader = document.getElementById('checkout_items');
                    if (contadorHeader) contadorHeader.textContent = data.cartCount;
                    
                    // Efecto visual premium
                    boton.classList.remove('btn-custom-artesanal', 'btn-primary');
                    boton.classList.add('btn-success');
                    boton.innerHTML = '<i class="bi bi-check-circle"></i> ¡Agregado!';

                    setTimeout(() => {
                        boton.classList.remove('btn-success', 'procesando');
                        boton.classList.add('btn-custom-artesanal');
                        boton.innerHTML = textoOriginal;
                        boton.disabled = false;
                    }, 2000);
                } else {
                    boton.disabled = false;
                    boton.classList.remove('procesando');
                }
            })
            .catch(error => {
                console.error('Error al agregar:', error);
                boton.innerHTML = textoOriginal;
                boton.classList.remove('procesando');
                boton.disabled = false;
            });
            return; // Cortamos la ejecución aquí si entró en este caso
        }

        // --- CASO B: BOTONES MÁS (+) Y MENOS (-) EN EL CARRITO ---
        const formCantidadBtn = e.target.closest('.form-cantidad-btn');
        if (formCantidadBtn) {
            e.preventDefault();
            e.stopImmediatePropagation();

            const url = formCantidadBtn.action;
            const formData = new FormData(formCantidadBtn);
            const fila = formCantidadBtn.closest('tr');

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const contadorHeader = document.getElementById('checkout_items');
                    if (contadorHeader) contadorHeader.textContent = data.cartCount;

                    if (data.removed) {
                        if (fila) fila.remove();
                    } else {
                        // Buscamos el input en la fila y actualizamos su valor
                        const inputNum = fila ? fila.querySelector('.input-cantidad-directa') : null;
                        if (inputNum) inputNum.value = data.cantidad;

                        const tdSubtotal = fila ? fila.querySelector('.td-subtotal') : null;
                        if (tdSubtotal) tdSubtotal.textContent = data.subtotal;
                    }

                    const totalGeneralContenedor = document.getElementById('total-general-carrito');
                    if (totalGeneralContenedor) totalGeneralContenedor.textContent = data.totalGeneral;
                }
            })
            .catch(error => console.error('Error en botón cantidad:', error));
            return;
        }

        // --- CASO C: EVITAR QUE EL ENTER DIRECTO RECARGUE LA PÁGINA EN EL INPUT ---
        const inputDirecto = e.target.querySelector('.input-cantidad-directa');
        if (inputDirecto) {
            e.preventDefault();
        }
    });

    // ==========================================================================
    // 2. CAPTURA GLOBAL DE CAMBIOS DIRECTOS EN EL INPUT (Escribir número y salir)
    // ==========================================================================
    document.addEventListener('change', function (e) {
        // Verificamos si el elemento que cambió es tu input de cantidad directa
        if (!e.target.classList.contains('input-cantidad-directa')) return;

        const input = e.target;
        const form = input.closest('form');
        if (!form) return;

        const url = form.action;
        const formData = new FormData(form);
        const fila = input.closest('tr');

        // Si ponen un número menor a 1 o lo dejan vacío, lo forzamos a 1
        if (parseInt(input.value) < 1 || input.value === '') {
            input.value = 1;
            formData.set('cantidad', 1);
        }

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const contadorHeader = document.getElementById('checkout_items');
                if (contadorHeader) contadorHeader.textContent = data.cartCount;

                const tdSubtotal = fila ? fila.querySelector('.td-subtotal') : null;
                if (tdSubtotal) tdSubtotal.textContent = data.subtotal;

                const totalGeneralContenedor = document.getElementById('total-general-carrito');
                if (totalGeneralContenedor) totalGeneralContenedor.textContent = data.totalGeneral;
            }
        })
        .catch(error => console.error('Error en cambio de input directo:', error));
    });
document.addEventListener('click', function(event) {
    const button = event.target.closest('.btn-abrir-modal');
    if (!button) return;

    const urlAccion = button.getAttribute('data-url');
    const nombre = button.getAttribute('data-nombre');

    const form = document.getElementById('form-delete-cart');
    if (form) {
        form.action = urlAccion;
    }

    const texto = document.getElementById('delete-modal-carrito');
    if (texto) {
        texto.innerHTML = `¿Estás seguro de que deseas quitar <strong>${nombre}</strong> del carrito?`;
    }

    const modalElement = document.getElementById('deleteCartModal');
    if (modalElement) {
        const modal = new bootstrap.Modal(modalElement);
        modal.show();
    }
});

}); 