<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [

    ];

    public function product()
    {
        $this->belongsTo(Product::class);
    }
    public function client()
    {
        $this->belongsTo(Client::class);
    }
    public function bill()
    {
        $this->belongsTo(Bill::class);
    }

}
