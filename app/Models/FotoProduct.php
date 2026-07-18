<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;


class FotoProduct extends Model
{
    protected $table = 'product_images';
    public $timestamps = false;
    
    protected $fillable = ['product_id', 'foto1', 'foto2', 'foto3'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}