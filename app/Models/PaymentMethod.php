<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentMethodFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'bill_id',
        'payment_method',
        'bank_type',
        'credit_card_type'
    ];

    public function bill()
    {
        $this->belongsTo(Bill::class);
    }

}
