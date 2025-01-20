<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Admincheck;
use App\Http\Middleware\Appointmentcheck;
use App\Http\Middleware\Blogcheck;
use App\Http\Middleware\Seocheck;
use App\Http\Middleware\Subadmincheck;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->appendToGroup('admin', [
            Admincheck::class
        ]);
        $middleware->appendToGroup('subadmin', [
            Subadmincheck::class
        ]);
        $middleware->appendToGroup('seo', [
            Seocheck::class
        ]);
        $middleware->appendToGroup('appointment', [
            Appointmentcheck::class
        ]);
        $middleware->appendToGroup('blog', [
            Blogcheck::class
        ]);
        $middleware->validateCsrfTokens(except: [
            'phonepe-response',
            'response'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
