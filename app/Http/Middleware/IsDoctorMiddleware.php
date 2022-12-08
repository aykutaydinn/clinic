<?php

namespace App\Http\Middleware;

use Closure;

class IsDoctorMiddleware
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
        if (auth()->user()->accType != 'DOC') {
            abort(404);
        }

        return $next($request);
    }
}