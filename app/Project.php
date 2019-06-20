<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use \App\Tanant\Traits\ForTanants;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}
