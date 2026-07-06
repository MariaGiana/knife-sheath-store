<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemporaryOrder;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * 1. AGREGAR UN PRODUCTO AL CARRITO
     * Corresponde a tu antigua sección de "addCar"
     */
    public function add(Request $request, $id)
    {
        // Obtenemos el token único de la sesión del visitante (Tu antiguo $_SESSION['tokenStoragel'])
        $tokenCliente = session()->getId(); 

        // Caso 1: Verificar si el producto ya existe en el carrito para este mismo token
        $cartItem = TemporaryOrder::where('token', $tokenCliente)
                                  ->where('product_id', $id)
                                  ->first();

        if ($cartItem) {
            // Si ya existe, aumentamos la cantidad (Como hacías en tu UPDATE)
            $cartItem->cantidad += 1;
            $cartItem->save();
        } else {
            // Caso 2: Si no existe, lo creamos desde cero (Como hacías en tu INSERT)
            $newItem = new TemporaryOrder();
            $newItem->product_id = $id;
            $newItem->cantidad = 1;
            $newItem->token = $tokenCliente;
            $newItem->save();
        }

        // Redirecciona a la página anterior con un mensaje de éxito
        return redirect()->back()->with('success', '¡Producto agregado al carrito!');
    }

   
    public function show()
    {
        $tokenCliente = session()->getId();

        // Traemos las órdenes temporales de este cliente con sus productos y fotos mediante Eloquent (Sin INNER JOIN manuales)
        $cartItems = TemporaryOrder::where('token', $tokenCliente)
                                    ->with('product.fotos')
                                    ->get();

        // Calculamos el total acumulado de la deuda en memoria (Tu función totalAcumuladoDeuda)
        $totalPagar = $cartItems->sum(function($item) {
            return $item->product->precio * $item->cantidad;
        });

        $cartCount = $cartItems->sum('cantidad');
      return view('cart', compact('cartItems', 'totalPagar', 'cartCount'));
    }


    /**
 * AUMENTAR CANTIDAD (+1)
 */
public function increase($id)
{
    // Buscamos el elemento en el carrito que pertenezca al token actual
    $cartItem = TemporaryOrder::where('token', session()->getId())->findOrFail($id);
    
    $cartItem->cantidad += 1;
    $cartItem->save();

    return redirect()->back();
}

public function decrease($id)
{
    $cartItem = TemporaryOrder::where('token', session()->getId())->findOrFail($id);

    if ($cartItem->cantidad > 1) {
        $cartItem->cantidad -= 1;
        $cartItem->save();
    } else {
        // Si la cantidad era 1 y bajan, se borra por completo del carrito
        $cartItem->delete();
    }

    return redirect()->back();
}


public function destroy($id)
{
    // Buscamos el registro que coincida con el ID y el token actual del cliente, y lo borramos
    TemporaryOrder::where('token', session()->getId())->findOrFail($id)->delete();

    // Redireccionamos de vuelta al carrito con un mensaje de éxito
    return redirect()->route('cart.show')->with('success', 'Producto eliminado del carrito.');
}
}