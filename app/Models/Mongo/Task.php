<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Relations\BelongsToMany;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\HasMany;

class Task extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'tasks';

    protected $fillable = [
        'name',
        'duration',
        'is_critical'
    ];

    /*
    ----------------------------------------------------------------

    ------------------------RELATIONS-------------------------------

    ----------------------------------------------------------------
    */


    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class);
    }
}
