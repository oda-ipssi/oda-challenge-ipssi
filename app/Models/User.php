<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 */
class User extends Model
{
    protected $table = 'users';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'password',
        'firstname',
        'lastname',
        'is_prospect',
        'remember_token'
    ];

    protected $guarded = [];

        
}