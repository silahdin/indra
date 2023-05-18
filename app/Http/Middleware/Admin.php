<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        if(auth()->user()->level == "admin" || auth()->user()->level == "Admin" || auth()->user()->level == "Administrator"){
            return $next($request);
            //return redirect('result.dashboard');
          }
            return redirect('home');
            //return redirect('home')->with('error','You have not admin access');
    }
}
