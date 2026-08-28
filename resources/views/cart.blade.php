@extends('layouts.app')

@section('content')
<div class="hero-artesanal">
    <div class="hero-content">
        <h1>Nuestras Vainas</h1>
        <p>Trabajo manual en puro cuero seleccionado</p>
    </div>
</div>

<div class="container my-5">
    <div class="cart-container-box">
        
        <h3 class="mb-4 title-cart text-center border-bottom pb-3" style="border-color: rgba(51,51,59,0.2) !important;">Resumen de tu Pedido</h3>

        @if($cartItems->isEmpty())
            <div class="text-center py-5">
                <p class="mb-4 font-weight-bold" style="color: #33333b; font-size: 1.2rem;">Tu carrito está vacío.</p>
                <a href="{{ url('/') }}" class="btn btn-custom-artesanal">
                    <i class="bi bi-arrow-left-circle"></i> Volver a la Tienda
                </a>
            </div>
        @else
            <div class="table-responsive">
        <table class="table table-bordered align-middle text-center m-0 table-custom">                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Foto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach($cartItems as $item)
                        <tr id="fila-carrito-{{ $item->id }}">
                            <td class="align-middle text-start font-weight-bold">{{ $item->product->name }}</td>
                            <td class="align-middle">
                                @if($item->product->fotos && $item->product->fotos->foto1)
                                    <img src="{{ asset('storage/' . $item->product->fotos->foto1) }}" alt="{{ $item->product->name }}" width="50" class="rounded shadow-sm" style="object-fit: contain;">
                                @else
                                    <span class="text-muted small">Sin imagen</span>
                                @endif
                            </td>
                            <td class="align-middle">${{ number_format($item->product->precio, 0, '', '.') }}</td>
                            
                            <td class="align-middle">
                                <div class="d-flex align-items-center justify-content-center">
                                    
                                    <form action="{{ route('cart.decrease', $item->id) }}" method="POST" class="d-inline form-cantidad-btn">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-custom px-2 py-1">
                                            <i class="bi bi-dash-lg"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('cart.update-quantity', $item->id) }}" method="POST" class="d-inline mx-2 form-input-directo">
                                        @csrf
                                        <input type="number" 
                                               name="cantidad" 
                                               value="{{ $item->cantidad }}" 
                                               min="1" 
                                               max="9999" 
                                               class="form-control text-center input-cantidad-directa" 
                                               style="width: 75px; font-weight: bold; display: inline-block;">
                                    </form>

                                    <form action="{{ route('cart.increase', $item->id) }}" method="POST" class="d-inline form-cantidad-btn">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-custom px-2 py-1">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                            <td class="align-middle td-subtotal font-weight-bold">${{ number_format($item->product->precio * $item->cantidad, 0, '', '.') }}</td>
                            <td class="align-middle">
                                <!--DELETE -->
                            <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                                @csrf
                                <button type="button" class="btn-eliminar-custom btn-abrir-modal" 
        data-url="{{ route('cart.delete', $item->id) }}" 
       data-nombre="{{ $item->product->name }}">
    <i class="bi bi-trash3-fill"></i>
</button>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
           <div class="text-end mt-4">
    <button class="btn btn-custom-artesanal px-4 py-2 fw-bold w-100 w-md-auto" type="button" data-bs-toggle="collapse" data-bs-target="#seccionFormularioEnvio" aria-expanded="false" aria-controls="seccionFormularioEnvio">
        <i class="bi bi-bag-check me-2"></i> Iniciar Pedido / Completar Datos
    </button>
</div>

<div class="collapse" id="seccionFormularioEnvio">
    @include('partials.formulario-envio')
</div>

    <div id="html-mensaje-exito" style="display:none;">
        @include('partials.mensaje-exito')
    </div>
            <div class="row align-items-center justify-content-between mt-4">
                <div class="col-md-6 mt-2">
                    <a href="{{ url('/') }}" class="btn btn-custom-artesanal">
                        <i class="bi bi-bag-plus"></i> Seguir Comprando
                    </a>
                </div>
                <div class="col-md-5 text-end mt-2">
                    <h3 class="font-weight-bold" style="color: #33333b; font-family: 'Playfair Display', serif;">
                        Total: <span id="total-general-carrito" style="color: #1e2136;">${{ number_format($totalPagar, 0, '', '.') }}</span>
                    </h3>
                </div>
            </div>
   @include('partials.delete-carrito')
        @endif

    </div>
</div>

@endsection

