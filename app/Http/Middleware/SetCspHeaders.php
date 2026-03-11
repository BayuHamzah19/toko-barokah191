<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetCspHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $csp = "default-src 'self'; " .
               // Script JS
               "script-src 'self' 'unsafe-inline' 'unsafe-eval' " .
               "https://app.sandbox.midtrans.com https://api.midtrans.com " .
               "https://cdn.jsdelivr.net https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/ " .
               "https://www.gstatic.com https://www.googleapis.com https://firebase.googleapis.com https://apis.google.com; " .
               // Style CSS
               "style-src 'self' 'unsafe-inline' " .
               "https://cdn.jsdelivr.net https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/; " .
               // Images
               "img-src 'self' data: https: blob:; " .
               // Connect / fetch / XHR / WebSocket
               "connect-src 'self' https://identitytoolkit.googleapis.com https://www.googleapis.com https://app.sandbox.midtrans.com https://api.midtrans.com https://cdn.jsdelivr.net" .
               "https://app.sandbox.midtrans.com https://api.midtrans.com " .
               "https://cdn.jsdelivr.net https://www.googleapis.com https://identitytoolkit.googleapis.com; " .
               // Iframe / frame
               "frame-src 'self' https://app.sandbox.midtrans.com https://accounts.google.com https://tokobarokah191.firebaseapp.com;" .
               // Fonts
               "font-src 'self' https://cdn.jsdelivr.net data:; " .
               "media-src 'self'; " .
               "object-src 'none'; " .
               "base-uri 'self';";

        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
