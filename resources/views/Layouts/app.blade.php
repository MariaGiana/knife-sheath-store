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

    @include('partials.whatsapp-modal')

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