<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TanantConnection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'database',
    ];
}
