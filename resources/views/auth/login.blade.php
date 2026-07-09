@extends('layouts.app')

@section('content')
<div style="padding-top: 100px; min-height: 80vh;">
    <div class="container d-flex justify-content-center">
        <div class="card border-0 shadow-lg p-4" 
             style="background-color: var(--color-fondo-crema); border-radius: 20px; max-width: 400px; width: 100%;">
            
            <h3 class="fw-bold mb-4 text-center" style="font-family: 'Playfair Display', serif; color: var(--color-texto-oscuro);">
                Acceso Admin
            </h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" 
                           style="border: 1px solid rgba(51,51,59,0.2);">
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-bold">Contraseña</label>
                    <input type="password" name="password" class="form-control" 
                           style="border: 1px solid rgba(51,51,59,0.2);">
                </div>
                
                <button type="submit" class="btn btn-custom-artesanal w-100 fw-bold">
                    Ingresar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection