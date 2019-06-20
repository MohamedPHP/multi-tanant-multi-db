<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Tanant\Manager;
use App\Tanant\Database\DatabaseManager;

class TanantIdentifiedListener
{

    public function __construct(DatabaseManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        app(Manager::class)->setTanant($event->tanant);

        $this->manager->createConnection($event->tanant);
    }
}
