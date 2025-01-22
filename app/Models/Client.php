<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;
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
