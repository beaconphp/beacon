<?php

declare(strict_types=1);

use App\Http\Middleware\CanAccessDashboardMiddleware;
use App\Http\Middleware\DashboardAuthenticate;
use App\Http\Middleware\HasWorkspace;
use App\Http\Middleware\SetWorkspaceContext;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth.dashboard' => DashboardAuthenticate::class,
            'can-access-dashboard' => CanAccessDashboardMiddleware::class,
            'has-workspace' => HasWorkspace::class,
            'set-workspace-context' => SetWorkspaceContext::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
