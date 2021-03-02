<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->roles_id === 2){
            return $next($request);
        }elseif(auth()->user()->roles_id === 1){
            return $next($request);
        }elseif(auth()->user()->roles_id === 3){
            return $next($request);
        }
        return redirect("/");
    }
}
