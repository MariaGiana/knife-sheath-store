<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemporaryOrder;
use App\Models\Product;

class CartController extends Controller
{

    public function add(Request $request, $id)
    {
        // Obtenemos el token único de la sesión del visitante 
        $tokenCliente = session()->getId(); 

        // Caso 1: Verificar si el producto ya existe en el carrito para este mismo token
        $cartItem = TemporaryOrder::where('token', $tokenCliente)
                                  ->where('product_id', $id)
                                  ->first();

        if ($cartItem) {
            // Si ya existe, aumentamos la cantidad 
            $cartItem->cantidad += 1;
            $cartItem->save();
        } else {
            // Caso 2: Si no existe, lo creamos desde cero
            $newItem = new TemporaryOrder();
            $newItem->product_id = $id;
            $newItem->cantidad = 1;
            $newItem->token = $tokenCliente;
            $newItem->save();
        }
         $totalProductos = TemporaryOrder::where('token', $tokenCliente)->sum('cantidad');

         // Si la petición viene vía AJAX/JavaScript, respondemos con JSON
        if ($request->ajax() || $request->wantsJson()) {
        return response()->json([
            'status' => 'success',
            'cartCount' => $totalProductos
        ]);
    }
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
public function increase(Request $request, $id)
{
    $tokenCliente = session()->getId();
    $cartItem = TemporaryOrder::where('token', $tokenCliente)->findOrFail($id);
    
    $cartItem->cantidad += 1;
    $cartItem->save();

    return $this->jsonCartResponse($request, $tokenCliente, $cartItem);
}

public function decrease(Request $request, $id)
{
    $tokenCliente = session()->getId();
    $cartItem = TemporaryOrder::where('token', $tokenCliente)->findOrFail($id);

    if ($cartItem->cantidad > 1) {
        $cartItem->cantidad -= 1;
        $cartItem->save();
        return $this->jsonCartResponse($request, $tokenCliente, $cartItem);
    } else {
        // Si era 1 y bajan, se elimina
        $cartItem->delete();
        return $this->jsonCartResponse($request, $tokenCliente, null);
    }
}


public function destroy($id)
{
    // Buscamos el registro que coincida con el ID y el token actual del cliente, y lo borramos
    TemporaryOrder::where('token', session()->getId())->findOrFail($id)->delete();

    // Redireccionamos de vuelta al carrito con un mensaje de éxito
    return redirect()->route('cart.show')->with('success', 'Producto eliminado del carrito.');
}

private function jsonCartResponse($request, $tokenCliente, $cartItem)
{
    // Calculamos el total general actual de la base de datos
    $items = TemporaryOrder::where('token', $tokenCliente)->get();
    $totalGeneral = $items->sum(function($item) {
        return $item->product->precio * $item->cantidad;
    });
    $totalProductos = $items->sum('cantidad');

    if ($request->ajax() || $request->wantsJson()) {
        return response()->json([
            'status' => 'success',
            'removed' => $cartItem ? false : true, // Le avisa a JS si debe borrar la fila entera de la pantalla
            'cantidad' => $cartItem ? $cartItem->cantidad : 0,
            'subtotal' => $cartItem ? '$' . number_format($cartItem->product->precio * $cartItem->cantidad, 0, '', '.') : '$0',
            'totalGeneral' => '$' . number_format($totalGeneral, 0, '', '.'),
            'cartCount' => $totalProductos
        ]);
    }

    return redirect()->back();
}
}