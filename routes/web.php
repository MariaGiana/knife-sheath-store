<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

// La página de inicio (Donde se muestran todas las vainas)
Route::get('/', [ProductController::class, 'index'])->name('home');

// El detalle de una vaina específica (Cuando hacen clic en una para verla más grande)
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.detail');

// Rutas iniciales del carrito
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');

//RUTAS DEL CARRITO
//rutas para aumentar, disminuir, agregar y eliminar la cantidad de un producto 
Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
Route::post('/cart/update-quantity/{id}', [CartController::class, 'updateQuantity'])->name('cart.update-quantity');
Route::post('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');

// Borrar todo el carrito de una sola vez (vaciar carrito)
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// El panel de administración (Donde tú o tu mamá van a loguearse para subir fotos)
Route::get('/admin/dashboard', function () {
    return "Aquí irá el panel de administración más adelante";
});

