<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
// Bootstrap App.php ->> global middleware 
class LogRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // what ever is on the header Request gives us access to

    public function handle(Request $request, Closure $next): Response
    {
        print('From the LogRequest middleware');
        Log::info("{$request->method()} - {$request->fullUrl()}");
        return $next($request);
    }
}
