<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products'; 

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function fotos()
    {
        return $this->hasOne(FotoProduct::class, 'product_id', 'id');
    }
}
class FotoProduct extends Model
{
    protected $table = 'product_images'; 

    protected $primaryKey = 'id';

    public $timestamps = false;
}

