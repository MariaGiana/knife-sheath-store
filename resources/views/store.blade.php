<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda Online. Vainas Artesanales</title>
</head>
<body>

    <div class="page-loading active">
        <div class="page-loading-inner">
            <div class="spinner"></div>
            <span>cargando...</span>
        </div>
    </div>
    
    <header>Aquí irá tu Header viejo más adelante</header>

    <div class="super_container">
        <div class="container mt-5 pt-5">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center">
                    <div class="section_title">
                        <img class="img-fluid" src="{{ asset('assets/images/manos212.jpg') }}" alt="portada">
                    </div>
                </div>
            </div>

            <div class="container mt-2 pt-2">
                <div class="row align-items-center">
                    <div class="col-lg-12 text-center">
                        <div class="border-text">
                            <div class="text_overlay"><h3>Nuestros Productos</h3></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row align-items-center">
                @foreach($products as $product)
                    <div class="col-6 col-md-3 mt-5 text-center Products">
                        <div class="card"> 
                            <div>
                                <img class="card-img-top" src="{{ asset($product->foto1) }}" alt="{{ $product->nameProd }}" style="max-width: 200px;">
                            </div>

                            <div class="card-body text-center">
                                <h5 class="card-title card_title">{{ $product->nameProd }}</h5>
                                <hr>
                                <p class="card-text p_puntos ">
                                    $ {{ number_format($product->precio, 0, '', '.') }}
                                </p>
                            </div>
                            
                            <a href="{{ route('product.detail', $product->id) }}" class="blue_button btn_puntos" title="Ver {{ $product->nameProd }}">
                                Ver Producto
                                <i class="bi bi-arrow-right-circle"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        <footer>Aquí irá tu Footer viejo más adelante</footer>
    </div>
    
</body>
</html>