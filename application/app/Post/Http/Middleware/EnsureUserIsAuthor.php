<?php

namespace App\Post\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAuthor
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()?->isAuthor()) {
            return response()->json([
                'message' => 'Forbidden. Author access required.',
            ], Response::HTTP_FORBIDDEN); 
        }

        return $next($request);
    }
}
