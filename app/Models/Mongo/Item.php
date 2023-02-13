<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Relations\BelongsToMany;
use Jenssegers\Mongodb\Eloquent\Model;

class Item extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'items';
    protected $fillable = [
        'name',
        'description',
        'expiration'
    ];

    /*
    ----------------------------------------------------------------

    ------------------------RELATIONS-------------------------------

    ----------------------------------------------------------------
    */

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class);
    }
}
