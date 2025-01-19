<?php

use Apiato\Foundation\Apiato;
use App\Containers\AppSection\Authentication\UI\WEB\Controllers\HomePageController;
use App\Containers\AppSection\Authentication\UI\WEB\Controllers\LoginPageController;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

$basePath = dirname(__DIR__);
$apiato = Apiato::configure(basePath: $basePath)->create();

return Application::configure(basePath: $basePath)
    ->withProviders($apiato->providers())
    ->withEvents($apiato->events())
    ->withRouting(
        web: $apiato->webRoutes(),
        channels: __DIR__ . '/../app/Ship/Broadcasting/channels.php',
        health: '/up',
        then: static fn () => $apiato->registerApiRoutes(),
    )
    ->withMiddleware(function (Middleware $middleware) use ($apiato) {
        $middleware->api($apiato->apiMiddlewares());
        $middleware->redirectUsersTo(function (Request $request) {
            return redirect()->action(HomePageController::class);
        });
        $middleware->redirectGuestsTo(function (Request $request) {
            return redirect()->action(LoginPageController::class);
        });
    })
    ->withCommands($apiato->commands())
    ->withExceptions(static function (Exceptions $exceptions) {})
    ->create();
