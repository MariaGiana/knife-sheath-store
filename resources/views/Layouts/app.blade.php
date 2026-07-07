<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vainas Artesanales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark navbar-transparente fixed-top">
        <div class="container">
            <a class="navbar-brand brand-artesanal" href="{{ url('/') }}">
                Vainas Artesanales
            </a>
            
            <div class="ms-auto">
                <a href="{{ route('cart.show') }}" class="btn btn-carrito-nav position-relative">
                    <i class="bi bi-cart3"></i>
                    <span id="checkout_items" class="badge badge-contador-nav position-absolute rounded-circle">
                        {{ $cartCount ?? 0 }}
                    </span>
                </a>
            </div>
        </div>
    </nav>

    <main class="mt-0">
        @yield('content')
    </main>

    <footer class="bg-dark text-white text-center py-4 mt-5" style="border-top: 3px solid #3e2723;">
        <div class="container">
            <p class="mb-0">© 2026 Vainas Artesanales - Tradición hecha a mano.</p>
        </div>
    </footer class="bg-dark">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/carrito-ajax.js') }}"></script>
</body>
</html>