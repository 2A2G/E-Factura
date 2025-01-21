<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';

    protected $fillable = [

    ];

    public function order()
    {
        $this->belongsTo(Order::class);
    }
    public function bill()
    {
        $this->hasMany(Bill::class);
    }
}
