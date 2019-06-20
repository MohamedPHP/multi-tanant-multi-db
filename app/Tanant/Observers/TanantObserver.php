<?php

namespace App\Tanant\Observers;

use Illuminate\Database\Eloquent\Model;
use App\TanantConnection;
use App\Tanant\Models\Tanant;

class TanantObserver
{
    /**
     * @param Model $tanant
     */
    function __construct(Model $tanant)
    {
        $this->tanant = $tanant;
    }

    /**
     * created
     * @param  Model  $model
     * @return void
     */
    public function created(Model $tanant) : void
    {
        $tanant->tanantConnection()->save(static::newDatabaseConnection($tanant));
    }

    /**
     * Creating New Database Connection
     * @param  Tanant           $tanant
     * @return TanantConnection
     */
    protected static function newDatabaseConnection(Tanant $tanant) : TanantConnection
    {
        return new TanantConnection([
            'database' => 'tanant_' . $tanant->id,
        ]);
    }
}
