<?php

namespace App\Http\Middleware;

use App\Patrones\Permiso;
use Closure;

class CheckAdministrador
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
        if (!Permiso::esAdministrador()) {
            abort(403);
        }
        return $next($request);
    }
}
