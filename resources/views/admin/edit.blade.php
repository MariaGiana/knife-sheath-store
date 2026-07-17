@extends('layouts.app')

@section('content')
<div style="padding-top: 50px; padding-bottom: 50px; min-height: 80vh;">
    <div class="container d-flex justify-content-center">
        <div class="card border-0 shadow-lg p-4" 
             style="background-color: var(--color-fondo-crema); border-radius: 20px; max-width: 500px; width: 100%;">
            
            <h3 class="fw-bold mb-4 text-center" style="font-family: 'Playfair Display', serif; color: var(--color-texto-oscuro);">
                Nuevo Producto
            </h3>

            {{-- Formulario de creación --}}
            <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Carga de Imágenes --}}
                <div class="mb-4">
                    <label class="form-label small fw-bold">Imágenes del Producto</label>
                    <div class="mt-2 text-start">
                        <input type="file" name="foto1" class="form-control mb-2" style="border: 1px solid rgba(51,51,59,0.2);">
                        <input type="file" name="foto2" class="form-control mb-2" style="border: 1px solid rgba(51,51,59,0.2);">
                        <input type="file" name="foto3" class="form-control" style="border: 1px solid rgba(51,51,59,0.2);">
                    </div>
                </div>

                {{-- Campo Nombre --}}
                <div class="mb-3">
                    <label class="form-label small fw-bold">Nombre del Producto</label>
                    <input type="text" name="name" class="form-control" 
                           style="border: 1px solid rgba(51,51,59,0.2);" 
                           value="{{ old('name') }}" required>
                </div>

                {{-- Campo Precio --}}
                <div class="mb-3">
                    <label class="form-label small fw-bold">Precio</label>
                    <input type="number" name="precio" class="form-control" 
                           style="border: 1px solid rgba(51,51,59,0.2);" 
                           value="{{ old('precio') }}" step="0.01" required>
                </div>

                {{-- Campo Descripción --}}
                <div class="mb-4">
                    <label class="form-label small fw-bold">Descripción</label>
                    <textarea name="description_product" class="form-control" 
                              style="border: 1px solid rgba(51,51,59,0.2);" 
                              rows="4" required>{{ old('description_product') }}</textarea>
                </div>

                {{-- Botones --}}
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-custom-artesanal fw-bold">
                        Guardar Producto
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary fw-bold" style="border-radius: 8px;">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
