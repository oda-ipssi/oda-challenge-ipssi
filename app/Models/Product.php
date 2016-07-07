<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 */
class Product extends Model
{
    protected $table = 'products';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'price'
    ];

    protected $guarded = [];

        
}