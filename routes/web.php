<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// La página de inicio
// Ruta que muestra el HTML (la que escribe el usuario en el navegador)
Route::get('/', [ProductController::class, 'index'])->name('store.index');

// Ruta exclusiva para el JSON (la que llama Alpine)
Route::get('/api/productos', [ProductController::class, 'getProductsJson']);

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


// PANEL DE ADMINISTRACIÓN (password: Admin1234, mail: admin@example.com)
// Rutas públicas
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

// Rutas protegidas (solo para admin)
Route::middleware(['auth:admin'])->group(function () {
    
// Dashboard principal
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');    
//   // rutas de agregar, edición y eliminación de un producto
    Route::get('/admin/productos/create', [AdminController::class, 'create'])->name('admin.productos.create');    
    Route::post('/admin/productos/store', [AdminController::class, 'store'])->name('admin.productos.store');
    
    Route::get('/admin/productos/edit/{id}', [AdminController::class, 'edit'])->name('admin.productos.edit');
    Route::put('/admin/productos/update/{id}', [AdminController::class, 'update'])->name('admin.productos.update');
    Route::delete('/admin/productos/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.productos.destroy');
});

