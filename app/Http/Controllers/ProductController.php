<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    public function index()
    {
        // Trae los productos y les "pega" sus respectivas fotos de la tabla fotoproducts
        $products = Product::join('fotoproducts', 'products.id', '=', 'fotoproducts.products_id')
                           ->select('products.*', 'fotoproducts.foto1', 'fotoproducts.foto2', 'fotoproducts.foto3')
                           ->get(); 

        // Los manda a la vista
        return view('store', compact('products'));
    }

    public function show($id)
    {
        return "Estás viendo el detalle de la vaina con el ID número: " . $id;
    }
}