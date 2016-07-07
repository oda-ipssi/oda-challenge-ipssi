<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrdersProduct
 */
class OrdersProduct extends Model
{
    protected $table = 'orders_products';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'order_id'
    ];

    protected $guarded = [];

        
}