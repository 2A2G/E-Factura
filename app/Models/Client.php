<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'type_identity',
        'number_identity',
        'email_client',
        'name_client',
        'phone_client',
        'address_client'
    ];

    public function orders()
    {
        return $this->hasManyThrough(Order::class, Bill::class, 'client_id', 'bill_id');
    }

    public function bill()
    {
        return $this->hasMany(Bill::class);
    }
}
