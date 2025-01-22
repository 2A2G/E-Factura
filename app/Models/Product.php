<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'type_products_id',
        'code_product',
        'name_product',
        'price_product',
        'quantity_products'
    ];

    public function typeProduct()
    {
        $this->belongsTo(TypeProduct::class);
    }

    public function order()
    {
        $this->belongsTo(Order::class);
    }


}
