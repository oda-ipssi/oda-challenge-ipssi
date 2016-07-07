<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Config
 */
class Config extends Model
{
    protected $table = 'configs';

    public $timestamps = false;

    protected $fillable = [
        'param',
        'value'
    ];

    protected $guarded = [];

        
}