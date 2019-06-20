<?php
use App\Tanant\Models\Tanant;


/**
 * getTanantDbName
 * @param  Tanant $tanant
 * @return string
 */
function getTanantDbName(Tanant $tanant) : string
{
    return str_replace('-', '_', str_slug(env('APP_NAME')))."_fresh_{$tanant->id}";
}
