<?php

namespace App\Http\Middleware;

use Closure;
use App\Company;
use App\Events\TanantIdentifiedEvent;

class SetTanant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (is_null(session('tanant'))) {
            session()->put('tanant', optional(auth()->user()->companies()->first())->uuid);
        }

        $tanant = $this->resolveTanant(session('tanant'));

        if (!$tanant) {
            return redirect('/');
        }

        if (!auth()->user()->companies->contains('id', $tanant->id)) {
            return redirect('/home');
        }

        event(new TanantIdentifiedEvent($tanant));

        return $next($request);
    }

    /**
     * Resolves a tanant
     * @param  string  $uuid
     * @return Company
     */
    public function resolveTanant($uuid)
    {
        if (is_null($uuid)) {
            $uuid = optional(auth()->user()->companies()->first())->uuid;
        }
        return Company::where('uuid', $uuid)->first();
    }
}
