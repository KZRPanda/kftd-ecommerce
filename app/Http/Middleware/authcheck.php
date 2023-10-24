<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class authcheck
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
        $cekdata = DB::table("user_login")->where("username","=",session()->get("id_user"))->first();
        
        if(session()->has("id_user") && !$cekdata){
            session()->pull("id_user");
        }

        if(!session()->has("id_user") && ($request->path() != 'login') && !$cekdata){
            return back()->with("not_permission","Kamu tidak memiliki izin!");
        }
        return $next($request);
    }
}
