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
        if(auth()->user()->rol === 2){
            return $next($request);
        }elseif(auth()->user()->rol === 1){
            redirect("/");
        }elseif(auth()->user()->rol === 3){
            redirect("/");
        }
        return redirect("/");
    }
}
