<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->group('api', middleware: [
            \App\Http\Middleware\ApiJson::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthenticationException $e) {
            return response([
                'status' => 401,
                'message' => $e->getMessage(),
            ], 401);
        });

        $exceptions->render(function (AuthenticationException $e) {
            return response([
                'status' => 403,
                'message' => $e->getMessage(),
            ], 403);
        });

        $exceptions->render(function (HttpException $e) {
            return response()->json([
                'status' => $e->getStatusCode(),
                'message' => $e->getMessage()
            ], $ex->getStatusCode());
        });

        $exceptions->render(function (\Throwable $e) {
            return response([
                'status' => 500,
                'message' => $e->getMessage(),
            ], 500);
        });
    })->create();
    
