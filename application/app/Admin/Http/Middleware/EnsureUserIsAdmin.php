<?php

namespace App\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()?->isAdmin()) {
            return response()->json([
                'message' => 'Forbidden. Admin access required.',
            ], Response::HTTP_FORBIDDEN); 
        }

        return $next($request);
    }
}
