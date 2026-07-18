<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FotoProduct;

class Product extends Model
{
    protected $table = 'products'; 

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['name', 'precio', 'description_product'];
    

    public function fotos()
    {
        return $this->hasOne(FotoProduct::class, 'product_id');
    }

}

