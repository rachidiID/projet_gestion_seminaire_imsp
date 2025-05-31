<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware; // Assurez-vous que cette classe est importée

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Enregistrement des alias de middleware de route (anciennement dans Kernel.php)
        $middleware->alias([
            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            // ... autres alias par défaut de Laravel ...

            // AJOUTEZ VOS ALIAS POUR SPATIE/LARAVEL-PERMISSION ICI :
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);

        // Vous pouvez aussi ajouter des middlewares globaux ou des groupes de middleware ici si besoin
        // $middleware->web(append: [
        //     // ...
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();