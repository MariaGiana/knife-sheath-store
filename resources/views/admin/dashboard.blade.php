@extends('layouts.app')

@section('content')
<div style="padding-top: 100px; min-height: 80vh;">
    <div class="container">
        <h2 class="fw-bold mb-4">Panel de Administración</h2>
        
        <div class="card shadow-sm p-4" style="background-color: var(--color-fondo-crema); border-radius: 20px;">
            <div class="d-flex justify-content-between mb-3">
                <h4>Productos</h4>
                <a href="#" class="btn btn-custom-artesanal">+ Nuevo Producto</a>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>${{ $product->precio }}</td>
                        <td style="max-width: 250px; word-wrap: break-word;">
                        {{ $product->description_product }}
                        </td>
                     <td>
    @if($product->fotos)
        <div class="d-flex gap-1">
            @if($product->fotos->foto1) <img src="{{ asset('storage/'.$product->fotos->foto1) }}" style="width:40px;"> @endif
            @if($product->fotos->foto2) <img src="{{ asset('storage/'.$product->fotos->foto2) }}" style="width:40px;"> @endif
            @if($product->fotos->foto3) <img src="{{ asset('storage/'.$product->fotos->foto3) }}" style="width:40px;"> @endif
        </div>
    @endif
</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning">Editar</a>
                            <form action="#" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

             <a href="{{ url('/') }}" class="btn btn-custom-artesanal">
                    <i class="bi bi-arrow-left-circle"></i> Volver a la Tienda
                </a>
        </div>
    </div>
</div>
@endsection