<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Cambiamos 'productos' por el nombre EXACTO de tu tabla real:
    protected $table = 'products'; 

    // Tu columna ID (la dejamos igual porque vimos en tu index viejo que era prodId)
    protected $primaryKey = 'id';

    public $timestamps = false;

    public function fotos()
    {
        // 1er parámetro: El modelo con el que se relaciona.
        // 2do parámetro: La columna en la tabla 'fotoproducts' que se conecta (products_id).
        // 3er parámetro: El ID local de este producto ('id').
        return $this->hasOne(FotoProduct::class, 'products_id', 'id');
    }
}
class FotoProduct extends Model
{
    protected $table = 'fotoproducts'; 

    protected $primaryKey = 'id';

    public $timestamps = false;
}

