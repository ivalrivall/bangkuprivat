<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecureHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $response->header('Cache-Control', 'max-age=31536000');

        return $response;
    }
}
