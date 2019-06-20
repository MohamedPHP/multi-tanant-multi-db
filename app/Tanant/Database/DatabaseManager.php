<?php


namespace App\Tanant\Database;

use App\Tanant\Models\Tanant;
use Illuminate\Database\DatabaseManager as LaravelDatabaseManager;


class DatabaseManager
{
    /**
     * Laravel Database Manager
     * @var \Illuminate\Database\DatabaseManager
     */
    private $manager;

    /**
     * __construct
     * @param LaravelDatabaseManager $manager
     */
    public function __construct(LaravelDatabaseManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Create Connection Data.
     * @param Tanant $tanant
     * @return void
     */
    public function createConnection(Tanant $tanant) : void
    {
        config()->set('database.connections.tanant', $this->getTanantConnection($tanant));
    }

    /**
     * Connect To Tanant
     * @return void
     */
    public function connectToTanant() : void
    {
        $this->manager->reconnect('tanant');
    }

    /**
     * Disconnect To Tanant
     * @return void
     */
    public function purgeFromTanant() : void
    {
        $this->manager->purge('tanant');
    }

    /**
     * Get Tanant Connection.
     * @param  Tanant $tanant
     * @return array
     */
    protected function getTanantConnection(Tanant $tanant) : array
    {
        return array_merge(config()->get($this->getConnectionPath()), $tanant->tanantConnection->only('database'));
    }

    /**
     * Get Connection Path.
     * @return string
     */
    protected function getConnectionPath() : string
    {
        return sprintf("database.connections.%s", $this->getDefaultConnectionType());
    }

    /**
     * Get Default Connection Type.
     * @return string
     */
    protected function getDefaultConnectionType() : string
    {
        return config()->get('database.default');
    }
}
