<?php

use App\Http\Middleware\LanguageMiddleware;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\ValidationHeaderMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(LanguageMiddleware::class);
        $middleware->api(append: ValidationHeaderMiddleware::class);
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(fn(QueryException $e) => response()->json([
            "status" =>"500", //Cada código
            "title"  =>"Database fail", //En función del código
            "details"=>"Access next please"

        ])
        );
    })->create();
