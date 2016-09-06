<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 */
class Order extends Model
{
    protected $table = 'orders';

    public $timestamps = true;

    protected $fillable = [
        'vat',
        'status',
        'user_id',
        'offer_id'
    ];

    protected $guarded = [];

        
}