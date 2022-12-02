<?php

namespace App\Http\Middleware;

use Closure;

class PermissionEditorOrAdmin
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

            if ($userInfo['is_admin'] == 1 || $userInfo['is_admin'] == 2)  return $next($request);
            return redirect()->route('notify/noPermission');
        }

        return redirect()->route('home');
    }
}

// news/login