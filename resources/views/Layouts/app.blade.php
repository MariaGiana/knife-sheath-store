<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Vainas Artesanales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@vite(['resources/js/app.js'])
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-transparente fixed-top">
        <div class="container d-flex align-items-center justify-content-between">
            
            <a class="navbar-brand brand-artesanal" href="{{ url('/') }}">
                Vainas Artesanales
            </a>
            
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-carrito-nav" data-bs-toggle="modal" data-bs-target="#modalConsultaWhatsApp" title="Hacer una consulta">
                    <i class="bi bi-chat-left-text"></i>
                </button>

                <a href="{{ route('cart.show') }}" class="btn btn-carrito-nav position-relative">
                    <i class="bi bi-cart3"></i>
                    <span id="checkout_items" class="badge badge-contador-nav position-absolute rounded-circle">
                        {{ $cartCount ?? 0 }}
                    </span>
                </a>
            </div>
        </div>
    </nav>

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

    <main class="mt-0">
        @yield('content')
    </main>

    <footer class="bg-dark text-white text-center py-4 mt-5" style="border-top: 3px solid #3e2723;">
        <div class="container">
            <p class="mb-0">© 2026 Vainas Artesanales - Tradición hecha a mano.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/carrito-ajax.js') }}"></script>
    <script src="{{ asset('assets/js/consulta-whatsapp.js') }}"></script>
   <script>
    // Esto lo lee Blade y le pone la ruta real antes de que el navegador lea el JS
    const URL_HOME = "{{ url('/') }}"
    const URL_VACIAR_CARRITO = "{{ route('cart.clear') }}";
    
</script>
<script src="{{ asset('assets/js/pedido-whatsapp.js') }}"></script>

</body>
</html>