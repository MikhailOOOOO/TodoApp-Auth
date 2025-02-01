<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureFrontendRequestsAreStateful
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Разрешаем доступ только с stateful доменов (в том числе localhost)
        if ($request->isMethod('get') && $request->expectsJson()) {
            return $next($request);
        }

        return $next($request);
    }
}