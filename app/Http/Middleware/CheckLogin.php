<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth as Auth;
class CheckLogin
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
        if(!$request->session()->has('user')){
            return redirect()->route('home');
        }
        return $next($request);
    }
}
