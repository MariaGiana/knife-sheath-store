<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemporaryOrder extends Model
{
    // 1. Le decimos explícitamente a qué tabla de phpMyAdmin debe apuntar
    protected $table = 'temporary_orders';

    // 2. Definimos los campos que Laravel tiene permiso de escribir/llenar
    protected $fillable = [
        'product_id',
        'cantidad',
        'token',
        'fecha'
    ];

    // 3. Como tu tabla original usa la columna 'fecha' (o no tiene created_at/updated_at),
    // desactivamos los timestamps automáticos de Laravel para que no se rompa.
    public $timestamps = false;

    /**
     * RELACIÓN: Una orden temporal pertenece a un Producto.
     * Esto equivale a tu antiguo INNER JOIN. 
     * Gracias a esto, en tu vista podrás hacer: $item->product->name
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}