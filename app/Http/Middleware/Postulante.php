<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class Postulante
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
        if(Auth::user()->isAdmin() || Auth::user()->isCoordinador() || Auth::user()->isAsistente())
            return redirect('/verificarpostulacion');
        return $next($request);
    }
}
