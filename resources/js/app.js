import './bootstrap'; // Esto importa el bootstrap.js de Laravel
import { Modal } from 'bootstrap'; 

// Hacemos que bootstrap sea accesible globalmente para Alpine
window.bootstrap = { Modal };

document.addEventListener('alpine:init', () => {
    Alpine.data('tienda', () => ({
        productos: [],

        async init() {
            try {
                const response = await fetch('/api/productos');
                this.productos = await response.json();
            } catch (error) {
                console.error("Error al cargar productos:", error);
            }
        },

        // Lógica del modal: inyecta los datos y abre el modal
        abrirModal(product) {
            // Asignamos textos
            document.getElementById('modal-title').innerText = product.nombre;
            document.getElementById('modal-desc').innerText = product.descripcion;
            document.getElementById('modal-price').innerText = product.precio;
            
            // Asignamos el ID para el carrito
            document.getElementById('modal-form-cart').dataset.id = product.id;

            // Lógica de imágenes (Carrusel) - Asegúrate que product.imagenes sea un array
            const carouselInner = document.getElementById('carousel-inner');
            carouselInner.innerHTML = product.imagenes.map((img, index) => `
                <div class="carousel-item ${index === 0 ? 'active' : ''}">
                    <img src="${img}" class="d-block w-100" alt="Producto">
                </div>
            `).join('');

            // Mostramos el modal usando Bootstrap
            const modal = new bootstrap.Modal(document.getElementById('productModal'));
            modal.show();
        },

        // Lógica de carrito sin recarga
        async agregarAlCarrito() {
            const productId = document.getElementById('modal-form-cart').dataset.id;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            try {
                const response = await fetch(`/cart/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    // Actualizamos el contador visualmente
                    const countElement = document.getElementById('cart-count');
                    if (countElement) {
                        countElement.innerText = parseInt(countElement.innerText || 0) + 1;
                    }
                    
                    // Cerramos modal
                    const modalElement = document.getElementById('productModal');
                    const modalInstance = bootstrap.Modal.getInstance(modalElement);
                    modalInstance.hide();
                    
                    alert('¡Producto agregado con éxito!');
                } else {
                    alert('Hubo un error al agregar el producto.');
                }
            } catch (error) {
                console.error("Error en el carrito:", error);
            }
        }

        
    }));

  
});