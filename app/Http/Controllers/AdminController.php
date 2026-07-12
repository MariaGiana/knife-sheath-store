<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class AdminController extends Controller
{
  public function index() 
{
    // Obtenemos todos los productos
    $products = \App\Models\Product::all(); 
    return view('admin.dashboard', compact('products')); 
}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = new \App\Models\Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $product->fotos()->create(['image_path' => $imagePath]);
        }

        $product->save();

        return redirect()->back()->with('success', 'Producto agregado exitosamente.');
    }
};

