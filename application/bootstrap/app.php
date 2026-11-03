<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Admin\Http\Middleware\EnsureUserIsAdmin::class,
            'author' => \App\Post\Http\Middleware\EnsureUserIsAuthor::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        
        $exceptions->shouldRenderJsonWhen(function (Request $request) {
            return $request->is('api/*') || $request->expectsJson();
        });

        $exceptions->render(function (ThrottleRequestsException $e) {
            return response()->json([
                'message' => 'Too Many Requests.',
                'retry_after' => $e->getHeaders()['Retry-After'] ?? null,
            ], Response::HTTP_TOO_MANY_REQUESTS);
        });
    })->create();
