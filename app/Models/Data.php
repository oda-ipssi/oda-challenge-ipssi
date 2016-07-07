<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Data
 */
class Data extends Model
{
    protected $table = 'datas';

    public $timestamps = false;

    protected $fillable = [
        'is_public',
        'user_id',
        'path'
    ];

    protected $guarded = [];

        
}