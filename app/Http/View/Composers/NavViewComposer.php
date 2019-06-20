<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Company;

class NavViewComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (auth()->check()) {
            $view->with('tanants', auth()->user()->companies);
        } else {
            $view->with('tanants', collect([]));
        }
    }
}
