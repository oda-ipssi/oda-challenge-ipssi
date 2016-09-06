<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Offer
 */
class Offer extends Model
{
    protected $table = 'offers';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'has_support',
        'has_update',
        'user_limit',
        'description',
        'database_limit',
        'price'
    ];

    protected $guarded = [];

        
}