<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = $request->query('key') ?? $request->header('X-ADMIN-KEY');
        
        if ($key !== env('ADMIN_KEY')) {
            abort(403, 'Unauthorized access: Invalid admin key.');
        }

        return $next($request);
    }
}
