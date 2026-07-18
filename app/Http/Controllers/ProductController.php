<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\TemporaryOrder;
use App\Models\FotoProduct;

class ProductController extends Controller
{

public function index()
{
    // El modelo se encarga de ir a buscar los productos y "pegarle" sus fotos automáticamente
    $products = Product::with('fotos')->get(); 
    // Contamos cuántos productos totales tiene el usuario en su carrito actual
    $cartCount = TemporaryOrder::where('token', session()->getId())->sum('cantidad');

    // Los manda a la vista
    return view('store', compact('products', 'cartCount'));
}


public function show($id)
    {
        return "Estás viendo el detalle de la vaina con el ID número: " . $id ;
    }
}