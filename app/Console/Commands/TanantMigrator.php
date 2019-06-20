<?php

namespace App\Console\Commands;

use Illuminate\Database\Console\Migrations\MigrateCommand;
use Illuminate\Database\Migrations\Migrator;
use App\Company;
use App\Tanant\Database\DatabaseManager;
use App\Events\TanantIdentifiedEvent;

class TanantMigrator extends MigrateCommand
{
    /**
     * The DatabaseManager.
     *
     * @var DatabaseManager
     */
    protected $db;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Migrations For Tanants';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Migrator $migrator, DatabaseManager $db)
    {
        parent::__construct($migrator);
        $this->setName('tanants:migrate');
        $this->db = $db;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!$this->confirmToProceed()) {
            return;
        }

        $this->input->setOption('database', 'tanant');

        $tanants = Company::get();

        $tanants->each(function ($tanant) {
            event(new TanantIdentifiedEvent($tanant));

            $this->db->connectToTanant();

            parent::handle();

            $this->db->purgeFromTanant();
        });


    }

    /**
     * Get all of the migration paths.
     *
     * @return array
     */
    protected function getMigrationPaths()
    {
        return [database_path('migrations/tanant')];
    }
}
