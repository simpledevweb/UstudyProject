<?php

use App\Http\Middleware\HasVerifiedPhone;
use App\Http\Middleware\IsVerifiedEmail;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'abilities' => CheckAbilities::class,
            'ability' => CheckForAnyAbility::class,
            'verified_email' => IsVerifiedEmail::class,
            'verified_phone' => HasVerifiedPhone::class,
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);

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

        $exceptions->render(function (AuthorizationException $e) {
            return response([
                'status' => 403,
                'message' => $e->getMessage(),
            ], 403);
        });

        $exceptions->render(function (HttpException $e) {
            return response()->json([
                'status' => $e->getStatusCode(),
                'message' => $e->getMessage()
            ], $e->getStatusCode());
        });

        $exceptions->render(function (\Throwable $e) {
            return response([
                'status' => 500,
                'message' => $e->getMessage(),
            ], 500);
        });
    })->create();

