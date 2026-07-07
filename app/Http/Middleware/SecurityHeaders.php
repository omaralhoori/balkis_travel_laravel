<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $csp = implode('; ', [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://analytics.tiktok.com https://connect.facebook.net https://www.googletagmanager.com https://www.googleadservices.com",
            "connect-src 'self' https://analytics.tiktok.com https://*.tiktok.com https://*.tiktokw.us https://*.tiktok.edgekey.net https://www.facebook.com https://connect.facebook.net https://www.google.com https://www.googleadservices.com https://googleads.g.doubleclick.net",
            "img-src 'self' data: blob: https://www.facebook.com https://www.google.com https://analytics.tiktok.com",
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com",
            "font-src 'self' https://fonts.gstatic.com data:",
            "frame-src 'self' https://www.facebook.com",
        ]);

        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
