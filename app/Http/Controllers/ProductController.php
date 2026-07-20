<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\TemporaryOrder;

class ProductController extends Controller
{

public function index() {
    // Solo carga la vista, no necesita enviar productos aún
    return view('store'); 
}

public function getProductsJson() {
    // Esta ruta solo responde con los datos
    return response()->json(Product::with('fotos')->get());
}
    
public function show($id)
    {
        $producto = Product::with('fotos')->findOrFail($id);

        // Si la petición viene de JS (usando axios o fetch), devuelve JSON
        if (request()->wantsJson()) {
            return response()->json($producto);
        }

        // Si es una petición normal del navegador, devuelve la vista Blade
        return view('products.show', compact('producto'));
    }
}