<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Events\TanantIdentifiedEvent;
use App\Events\TanantWasCreated;
use App\Listeners\TanantIdentifiedListener;
use App\Listeners\CreateTanantDatabase;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TanantIdentifiedEvent::class => [
            TanantIdentifiedListener::class,
        ],
        TanantWasCreated::class => [
            CreateTanantDatabase::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
