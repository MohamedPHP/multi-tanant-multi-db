<?php

namespace App\Tanant;

use App\Company;


class Manager
{
    /**
     * @var $tanant
     */
    protected $tanant;

    /**
     * setTanant
     * @param Company $tanant [description]
     * @return bool
     */
    public function setTanant($tanant) : bool
    {
        if ($this->checkTanant($tanant)) {
            $this->tanant = $tanant;
            return true;
        }
        return false;
    }

    /**
     * getTanant
     * @return mixed
     */
    public function getTanant()
    {
        return $this->checkTanant() ? $this->tanant : false;
    }

    /**
     * checkTanant
     * @param $tanant
     * @return bool
     */
    public function checkTanant($tanant = null) : bool
    {
        if (is_null($tanant)) {
            return $this->tanant instanceof Company;
        }
        return $tanant instanceof Company;
    }
}
