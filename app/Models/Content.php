<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Content
 */
class Content extends Model
{
    protected $table = 'contents';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'content',
        'url'
    ];

    protected $guarded = [];

        
}