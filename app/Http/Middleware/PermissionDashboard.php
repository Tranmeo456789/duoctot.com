<?php

namespace App\Http\Middleware;

use Closure;

class PermissionDashboard
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
            if (($userInfo['user_type_id'] > 3 && $userInfo['user_type_id'] < 10 ) || $userInfo['is_admin'] == 1){
                return $next($request);
            }  
            if ( $userInfo['user_type_id'] == 10 ){
                return redirect()->route('affiliate.dashboardRef');
            }
            return redirect()->route('profile.info');
        }

        return redirect()->route('home');
    }
}

// news/login