<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
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

//PANEL DE ADMINISTRACIÓN
// Rutas públicas (no necesitan login)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
// Ruta del Dashboard (donde va después de loguearse)
Route::get('/admin/dashboard', function () {
    return "Bienvenido al panel administrativo";
})->middleware('auth:admin'); // Esto es lo que protege la ruta

// Rutas protegidas (solo para admin)
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::post('/admin/productos/store', [AdminController::class, 'store']);
});

