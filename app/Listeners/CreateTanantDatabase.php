<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Tanant\Database\DatabaseCreator;

class CreateTanantDatabase
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(DatabaseCreator $database)
    {
        $this->database = $database;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $databaseName = getTanantDbName($event->tanant);

        $db = \DB::select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =  ?", [$databaseName]);

        if(empty($db)){
            if (!$this->database->create($event->tanant, $databaseName)) {
                throw new \Exception("Faild To Create The Database.", 1);
            }
        }
    }
}
