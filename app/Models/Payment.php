<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
*	Class Payment
*/
class Payment extends Model
{
    protected $table = 'payments';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'order_id',
        'paymentMethod',
        'amount',
        'cardNumber',
        'expirationDate',
        'created_at'
    ];

    protected $guarded = [];

}

