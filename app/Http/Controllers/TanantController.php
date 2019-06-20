<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class TanantController extends Controller
{
    /**
     * Switches The Current Tanant
     * @param  Tanant $tanant
     * @return Illuminate\Http\Response
     */
    public function switch($tanant)
    {
        $tanant = Company::find($tanant);
        
        session()->put('tanant', $tanant->uuid);

        return redirect('/home');
    }
}
