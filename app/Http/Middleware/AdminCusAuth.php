<?php

namespace App\Http\Middleware;

use Closure;
use CusAuth;

class AdminCusAuth
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
        if(!CusAuth::user()) { 
            return redirect()->route('login');
        }
        
        if(CusAuth::user()->grade != 250) {
            return redirect('/User/profile');
        }

        return $next($request);
    }
}
