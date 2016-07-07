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
        'description',
        'database_limit',
        'price'
    ];

    protected $guarded = [];

        
}