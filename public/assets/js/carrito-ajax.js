document.addEventListener('DOMContentLoaded', function () {
    
    // 1. ESCUCHAR EL BOTÓN "AGREGAR AL CARRITO" (PÁGINA PRINCIPAL)
    const formsAgregar = document.querySelectorAll('.form-agregar-carrito');
    formsAgregar.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); 

            const url = this.action;
            const formData = new FormData(this);

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const contadorHeader = document.getElementById('checkout_items');
                    if (contadorHeader) {
                        contadorHeader.textContent = data.cartCount;
                    }
                }
            })
            .catch(error => console.error('Error al agregar producto:', error));
        });
    });

    // 2. ESCUCHAR LOS BOTONES DE MÁS (+) Y MENOS (-) EN EL CARRITO
    const formsCantidad = document.querySelectorAll('.form-cantidad-carrito');
    formsCantidad.forEach(form => {
        form.addEventListener('submit', function (e) {
            // DETIENE LA RECARGA DE FORMA ESTRICTA
            e.preventDefault();

            const url = this.action;
            const formData = new FormData(this);
            const fila = this.closest('tr');

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Actualiza el contador del header
                    const contadorHeader = document.getElementById('checkout_items');
                    if (contadorHeader) contadorHeader.textContent = data.cartCount;

                    // Si llegó a 0, remueve la fila
                    if (data.removed) {
                        if (fila) fila.remove();
                    } else {
                        // Modifica los datos internos de la fila actual
                        const spanCantidad = fila.querySelector('.span-cantidad');
                        const tdSubtotal = fila.querySelector('.td-subtotal');
                        
                        if (spanCantidad) spanCantidad.textContent = data.cantidad;
                        if (tdSubtotal) tdSubtotal.textContent = data.subtotal;
                    }

                    // Actualiza el total general abajo de la tabla
                    const totalGeneralContenedor = document.getElementById('total-general-carrito');
                    if (totalGeneralContenedor) {
                        totalGeneralContenedor.textContent = data.totalGeneral;
                    }
                }
            })
            .catch(error => console.error('Error al modificar cantidad:', error));
        });
    });

});