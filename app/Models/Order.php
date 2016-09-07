<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 */
class Order extends Model
{

    const STATUS_OK = 1;
    const STATUS_RENEWED = 2;
    const STATUS_STOP = 3;


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