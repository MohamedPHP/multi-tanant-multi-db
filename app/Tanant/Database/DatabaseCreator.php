<?php


namespace App\Tanant\Database;

use App\Tanant\Models\Tanant;

use DB;

class DatabaseCreator
{
    /**
     * Create Database
     * @param  Tanant $tanant
     * @param  string $databaseName
     * @return mixed
     */
    public function create(Tanant $tanant, string $databaseName)
    {
        try {
            return DB::statement("
                CREATE DATABASE $databaseName
            ");
        } catch (\Exception $e) {
            return false;
        }

    }
}
