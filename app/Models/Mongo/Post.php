<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\BelongsTo;
use Jenssegers\Mongodb\Relations\HasOne;

class Post extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'posts';
    protected $fillable = [
        'title',
        'body',
        'slug',
        'task_id'
    ];

    /*
    ----------------------------------------------------------------

    ------------------------RELATIONS-------------------------------

    ----------------------------------------------------------------
    */

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
