<?php

namespace App\Tanant\Traits;

use Illuminate\Database\Eloquent\Relations\HasOne;
use App\TanantConnection;
use App\Tanant\Observers\TanantObserver;
use App\Tanant\Models\Tanant;

trait IsTanant {

    public static function boot()
    {
        parent::boot();

        static::creating(function ($tanant) {
            $tanant->uuid = rand(10000, 99999) . '_' . rand(10000, 99999) . '_' . (rand(100, 999) * rand(100, 999));
        });

        static::created(function ($tanant) {
            $tanant->tanantConnection()->save(static::newDatabaseConnection($tanant));
        });
    }

    /**
     * Creating New Database Connection
     * @param  Tanant           $tanant
     * @return TanantConnection
     */
    protected static function newDatabaseConnection(Tanant $tanant) : TanantConnection
    {
        return new TanantConnection([
            'database' => getTanantDbName($tanant),
        ]);
    }

    /**
     * tanantConnection
     * @return HasOne
     */
    public function tanantConnection() : HasOne
    {
        return $this->hasOne(TanantConnection::class, $this->getForeignKey(), 'id');
    }
}
