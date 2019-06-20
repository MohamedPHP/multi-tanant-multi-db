<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use App\Tanant\Manager;
use App\Tanant\Database\DatabaseManager;
use App\Console\Commands\TanantMigrator;

class TanantServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TanantMigrator::class, function ($app) {
            return new TanantMigrator($app->make('migrator'), $app->make(DatabaseManager::class));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Manager::class, function () {
            return new Manager;
        });

        Request::macro('tanant', function () {
            return app(Manager::class)->getTanant();
        });
    }
}
