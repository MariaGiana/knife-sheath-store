@extends('layouts.app')

@section('content')
<div style="padding-top: 50px; padding-bottom: 50px; min-height: 80vh;">
    <div class="container d-flex justify-content-center">
        <div class="card border-0 shadow-lg p-4" 
             style="background-color: var(--color-fondo-crema); border-radius: 20px; max-width: 500px; width: 100%;">
            
            <h3 class="fw-bold mb-4 text-center" style="font-family: 'Playfair Display', serif; color: var(--color-texto-oscuro);">
                Editar: {{ $product->name }}
            </h3>

            {{-- IMPORTANTE: Aquí la ruta lleva el ID y usamos el método PUT --}}
            <form action="{{ route('admin.productos.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') 

                {{-- Carga de Imágenes (Igual que antes) --}}
                <div class="mb-4">
                    <label class="form-label small fw-bold">Imágenes actuales</label>
                    <div class="d-flex gap-2 mb-2">
                        @foreach(['foto1', 'foto2', 'foto3'] as $f)
                            @if($product->fotos?->$f)
                                <img src="{{ asset('storage/' . $product->fotos->$f) }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                            @endif
                        @endforeach
                    </div>
                    <label class="form-label small fw-bold">Actualizar imágenes</label>
                    <input type="file" name="foto1" class="form-control mb-2">
                    <input type="file" name="foto2" class="form-control mb-2">
                    <input type="file" name="foto3" class="form-control">
                </div>

                {{-- Campo Nombre con valor precargado --}}
                <div class="mb-3">
                    <label class="form-label small fw-bold">Nombre del Producto</label>
                    <input type="text" name="name" class="form-control" 
                           value="{{ old('name', $product->name) }}" required>
                </div>

                {{-- Campo Precio con valor precargado --}}
                <div class="mb-3">
                    <label class="form-label small fw-bold">Precio</label>
                    <input type="number" name="precio" class="form-control" 
                           value="{{ old('precio', $product->precio) }}" step="0.01" required>
                </div>

                {{-- Campo Descripción con valor precargado --}}
                <div class="mb-4">
                    <label class="form-label small fw-bold">Descripción</label>
                    <textarea name="description_product" class="form-control" rows="4" required>{{ old('description_product', $product->description_product) }}</textarea>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-custom-artesanal fw-bold">
                        Actualizar Producto
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary fw-bold">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection