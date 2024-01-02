<?php

namespace App\Http\Middleware;

use Closure;

class PermissionAffiliate
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
        if($request->session()->has('user'))  {
            $userInfo = $request->session()->get('user');
            if ($userInfo['is_affiliate'] == 1){
                return $next($request);
            }  
            return redirect()->route('profile.info');
        }

        return redirect()->route('home');
    }
}
