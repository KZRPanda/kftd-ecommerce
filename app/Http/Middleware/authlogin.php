<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class authlogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        session()->pull("id_admin");
        session()->pull("id_user");
        session()->pull("id_fakturis");
        session()->pull("id_logistik");
        if(session()->has("id_admin") || session()->has("id_user") || session()->has("id_logistik") || session()->has("id_fakturis")){
            return back();
        }
        return $next($request);
    }
}
