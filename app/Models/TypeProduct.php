<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_type_name'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
