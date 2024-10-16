<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);

        $middleware->alias([
            'authCustom' => \App\Http\Middleware\authCustom::class,
            'isAdmin' => \App\Http\Middleware\isAdmin::class,
            'isRegisteredUser' => \App\Http\Middleware\isRegisteredUser::class,
            'isRegisteredOrAdmin' => \App\Http\Middleware\isRegisteredOrAdmin::class,
            'lang' => \App\Http\Middleware\language::class,
        ]);
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
