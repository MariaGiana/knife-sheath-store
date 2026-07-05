<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// 1. La página de inicio (Donde se muestran todas las vainas)
Route::get('/', [ProductController::class, 'index'])->name('home');

// 2. El detalle de una vaina específica (Cuando hacen clic en una para verla más grande)
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.detail');

// 3. El panel de administración (Donde tú o tu mamá van a loguearse para subir fotos)
Route::get('/admin/dashboard', function () {
    return "Aquí irá el panel de administración más adelante";
});

