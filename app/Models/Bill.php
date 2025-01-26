<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'client_id',
        'reference_code',
        'cufe'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, Order::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function paymentMethod()
    {
        return $this->hasMany(PaymentMethod::class);
    }
}
