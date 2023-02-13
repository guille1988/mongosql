<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Eloquent\Model;

class User extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'post_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
