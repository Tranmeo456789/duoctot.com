<?php

namespace App\Http\Middleware;

use Closure;

class ZaloNoCache
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $ua = strtolower($request->header('user-agent', ''));

        if (
            strpos($ua, 'zalo') !== false ||
            strpos($ua, 'facebook') !== false ||
            strpos($ua, 'facebot') !== false
        ) {
            $response->headers->set(
                'Cache-Control',
                'no-store, no-cache, must-revalidate, max-age=0'
            );
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', '0');
        }

        return $response;
    }
}