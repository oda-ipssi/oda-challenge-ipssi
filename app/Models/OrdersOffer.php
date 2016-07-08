<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrdersOffer
 */
class OrdersOffer extends Model
{
    protected $table = 'orders_offers';

    public $timestamps = false;

    protected $fillable = [
        'offer_id',
        'order_id'
    ];

    protected $guarded = [];

        
}