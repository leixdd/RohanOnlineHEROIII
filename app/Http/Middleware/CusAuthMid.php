<?php

namespace App\Http\Middleware;

use Closure;
use CusAuth;
use App\Model\RFSConfirmations;


class CusAuthMid
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

        if(RFSConfirmations::where('user_id', CusAuth::user()->user_id)->get()[0]->isConfirm == 0) {
            return redirect('/User/confirmation');
        }

        return $next($request);
    }
}
