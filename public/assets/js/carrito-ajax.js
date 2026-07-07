document.addEventListener('DOMContentLoaded', function () {
    
   // 1. CONTROLAR BOTÓN "AGREGAR AL CARRITO" (OPCIÓN CON ANIMACIÓN EN EL BOTÓN)
    const formsAgregar = document.querySelectorAll('.form-agregar-carrito');
    formsAgregar.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); 
            const url = this.action;
            const formData = new FormData(this);
            
            // Encontrás el botón que disparó la acción
            const boton = this.querySelector('button[type="submit"]');
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
                    
                    // EFECTO VISUAL ELEGANTE: Cambia el botón a verde y dice Agregado
                    boton.classList.remove('btn-primary');
                    boton.classList.add('btn-success');
                    boton.innerHTML = '<i class="bi bi-check-circle"></i> ¡Agregado!';
                    boton.disabled = true;

                    // A los 2 segundos vuelve a su estado normal
                    setTimeout(() => {
                        boton.classList.remove('btn-success');
                        boton.classList.add('btn-primary');
                        boton.innerHTML = textoOriginal;
                        boton.disabled = false;
                    }, 2000);
                }
            })
            .catch(error => console.error('Error al agregar:', error));
        });
    });

    // 2. CONTROLAR CLICS EN BOTONES MÁS (+) Y MENOS (-)
    const formsBotones = document.querySelectorAll('.form-cantidad-btn');
    formsBotones.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const url = this.action;
            const formData = new FormData(this);
            const fila = this.closest('tr');

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
                        fila.remove();
                    } else {
                        // ACTUALIZACIÓN CLAVE: Buscamos el input y cambiamos su valor dinámicamente
                        const inputNum = fila.querySelector('.input-cantidad-directa');
                        if (inputNum) inputNum.value = data.cantidad;

                        const tdSubtotal = fila.querySelector('.td-subtotal');
                        if (tdSubtotal) tdSubtotal.textContent = data.subtotal;
                    }

                    const totalGeneralContenedor = document.getElementById('total-general-carrito');
                    if (totalGeneralContenedor) totalGeneralContenedor.textContent = data.totalGeneral;
                }
            })
            .catch(error => console.error('Error en botón:', error));
        });
    });

    // 3. CONTROLAR CUANDO SE ESCRIBE UN NÚMERO DIRECTO Y SE DA ENTER O SE HACE CLIC AFUERA
    const inputsCantidad = document.querySelectorAll('.input-cantidad-directa');
    inputsCantidad.forEach(input => {
        input.addEventListener('change', function () {
            const form = this.closest('form');
            const url = form.action;
            const formData = new FormData(form);
            const fila = this.closest('tr');

            if (parseInt(this.value) < 1 || this.value === '') {
                this.value = 1;
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

                    const tdSubtotal = fila.querySelector('.td-subtotal');
                    if (tdSubtotal) tdSubtotal.textContent = data.subtotal;

                    const totalGeneralContenedor = document.getElementById('total-general-carrito');
                    if (totalGeneralContenedor) totalGeneralContenedor.textContent = data.totalGeneral;
                }
            })
            .catch(error => console.error('Error en input directo:', error));
        });

        // Evita que el Enter haga un submit clásico que recargue la página
        input.closest('form').addEventListener('submit', function(e) {
            e.preventDefault();
        });
    });
});