<?php

namespace App\Http\Middleware;

use App\Patrones\Permiso;
use Closure;

class CheckVendedor
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
        if (!Permiso::esVendedor()) {
            abort(403);
        }
        return $next($request);
    }
}
