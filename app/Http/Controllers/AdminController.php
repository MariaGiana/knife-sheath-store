<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\FotoProduct;


class AdminController extends Controller
{

public function index() 
    {
        // Obtenemos todos los productos
        $products = Product::all();
        return view('admin.dashboard', compact('products')); 
    }

public function store(Request $request)
        {
            // 1. Validar los datos
            $request->validate([
                'name' => 'required|string|max:255',
                'precio' => 'required|numeric',
                'description_product' => 'required|string',
            ]);

            // 2. Crear el producto
            $product = Product::create([
                'name' => $request->name,
                'precio' => $request->precio,
                'description_product' => $request->description_product,
            ]);

            // 3. Gestionar las fotos (si se subieron)
            $fotosData = [];
            foreach (['foto1', 'foto2', 'foto3'] as $columna) {
                if ($request->hasFile($columna)) {
                    $path = $request->file($columna)->store('products', 'public');
                    $fotosData[$columna] = $path;
                }
            }

            $product->fotos()->create($fotosData);

            return redirect()->route('admin.dashboard')->with('success', 'Producto creado con éxito');
        }
public function create()
    {
        return view('admin.create');
    }

public function edit($id)
    {
       $product = Product::with('fotos')->findOrFail($id);   
        return view('admin.edit', compact('product'));
    }    

public function update(Request $request, $id)
    {
        $product = Product::with('fotos')->findOrFail($id);
        
        // 1. Actualizar datos básicos (name, price, etc)
        $product->update($request->only(['name', 'precio', 'description_product']));

        // 2. Gestionar las fotos
        if (!$product->fotos) {
            $product->fotos()->create([]); // Crea el registro si no existe
        }

        $fotosData = [];
        foreach (['foto1', 'foto2', 'foto3'] as $columna) {
            if ($request->hasFile($columna)) {
                $path = $request->file($columna)->store('products', 'public');
                $fotosData[$columna] = $path;
            }
        }

        if (!empty($fotosData)) {
            $product->fotos()->update($fotosData);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Producto actualizado con éxito');
    }


public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // --- MODO SIMULACIÓN ---
        //dd("Simulación: Se borraría el producto con ID: " . $product->id . " y nombre: " . $product->name);
        // -----------------------

        // borrar de verdad
        $product->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Producto borrado con éxito');
    }

}

