<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Providers\StorageServiceProvider;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->alias ([
            'isAdmin' => App\Http\Middleware\IsAdmin::class,
            'isGuest' => App\Http\Middleware\IsGuest::class,
            'isStaff' => App\Http\Middleware\IsStaff::class,
            'isAnggota' => App\Http\Middleware\IsAnggota::class,
            'isAdminOrStaff' => App\Http\Middleware\IsAdminOrStaff::class
    ]);
    })
    ->withProviders([
        StorageServiceProvider::class,
    ])          

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
