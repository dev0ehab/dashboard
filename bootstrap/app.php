<?php

use App\Http\Middleware\LocalesMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Modules\Accounts\Http\Middlewares\AuthModelMiddleware;
use Modules\Accounts\Http\Middlewares\AuthTypeMiddleware;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(LocalesMiddleware::class);
        $middleware->alias([
            'auth-type' => AuthTypeMiddleware::class,
            'auth-model' => AuthModelMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        if (!env('APP_DEBUG')) {

            $exceptions->render(function (NotFoundHttpException $e, Request $request) {
                if ($request->is('api/*') && $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'data' => [],
                        'message' => trans('messages.not found')
                    ], 404);
                }
            });
        }

        $exceptions->render(function (HttpException $e, Request $request) {
            if ($request->is('api/*')) {

                return response()->json(['success' => false, 'message' => trans($e->getMessage())]);
            }
        });
    })->create();
