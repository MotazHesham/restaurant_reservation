<?php

use App\Helpers\ResponseHelper;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\ForceJsonRequestMiddleware;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) { 
        $middleware->append([ForceJsonRequestMiddleware::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        
        $exceptions->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return ResponseHelper::returnResponse(
                    null,
                    env('APP_ENV') !== 'local' ? 'Record not found.' : $e->getMessage(),
                    false,
                    Response::HTTP_NOT_FOUND
                );
            }
        });
    })->create();
