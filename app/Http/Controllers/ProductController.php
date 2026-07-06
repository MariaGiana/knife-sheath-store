<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{

public function index()
{
    // El modelo se encarga de ir a buscar los productos y "pegarle" sus fotos automáticamente
    $products = Product::with('fotos')->get(); 

    // Los manda a la vista
    return view('store', compact('products'));
}


public function show($id)
    {
        return "Estás viendo el detalle de la vaina con el ID número: " . $id ;
    }
}