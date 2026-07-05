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
}