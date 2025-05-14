<?php

namespace App\Http\Middleware;

use Barryvdh\Debugbar\Facades\Debugbar;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && !$user->isActive()) {
            Auth::guard()->logout();
            $request->session()?->invalidate();
            $request->session()?->regenerateToken();

            // API → JSON 403
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Je account is niet (meer) actief.'
                ], 403);
            }

            // Web → redirect to log in
            return redirect(route('login'))
                ->with(['flash' => [
                    'type' => 'warning',
                    'message' => 'Je account is niet (meer) actief.',
                    'duration' => 3000
                ]]);
        }

        return $next($request);
    }
}
