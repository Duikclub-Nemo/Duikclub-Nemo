<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateLastOnline
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($user = auth()->user()) {
            $user->timestamps = false;
            $user->last_online = now();
            $user->last_visited = $request->getRequestUri();
            $user->saveQuietly();
        }

        return $next($request);
    }
}
