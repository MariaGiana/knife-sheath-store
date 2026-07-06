@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Mi Carrito de Compras</h2>

    @if($cartItems->isEmpty())
        <div class="row align-items-center">
            <div class="col-lg-12 text-center mt-5">
                <div class="alert alert-warning" role="alert">
                    <strong>Ops.!</strong> Tu carrito está vacío.
                </div>
            </div>
            <div class="col-lg-12 text-center mt-5 mb-5">
                <a href="{{ url('/') }}" class="btn btn-primary">
                    <i class="bi bi-arrow-left-circle"></i> Volver a la Tienda
                </a>
            </div>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
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
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>
    @if($item->product->fotos && $item->product->fotos->foto1)
        <img src="{{ asset($item->product->fotos->foto1) }}" alt="{{ $item->product->name }}" width="50" style="object-fit: contain;">
    @else
        <span class="text-muted small">Sin imagen</span>
    @endif
</td>
                            <td>${{ number_format($item->product->precio, 0, '', '.') }}</td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <form action="{{ route('cart.decrease', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-secondary px-2 py-0">
                                            <i class="bi bi-dash-lg"></i>
                                        </button>
                                    </form>

                                    <span class="mx-3 font-weight-bold" style="font-size: 1.1rem;">
                                        {{ $item->cantidad }}
                                    </span>

                                    <form action="{{ route('cart.increase', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-secondary px-2 py-0">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>${{ number_format($item->product->precio * $item->cantidad, 0, '', '.') }}</td>
                            <td>
                            <form action="{{ route('cart.delete', $item->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres quitar este producto del carrito?');">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row justify-content-end mt-4">
            <div class="col-md-4 text-right">
                <h4>Total a Pagar: <span class="text-success">${{ number_format($totalPagar, 0, '', '.') }}</span></h4>
            </div>
        </div>
    @endif
</div>
@endsection