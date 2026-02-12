<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
   ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            'posts',      // Libera a criação de postagens
            'posts/*',    // Libera a edição de postagens
        ]);

        $middleware->redirectTo(
            guests: '/posts', // Se ele achar que você é convidado, ele te mantém na lista, não no login
            users: '/posts'
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
