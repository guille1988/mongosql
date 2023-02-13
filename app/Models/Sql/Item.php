<?php

namespace App\Models\Sql;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

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
        return $this->belongsToMany(Task::class)->withTimestamps();
    }
}
