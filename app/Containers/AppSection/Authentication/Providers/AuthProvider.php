<?php

namespace App\Containers\AppSection\Authentication\Providers;

use Apiato\Core\Loaders\RoutesLoaderTrait;
use App\Ship\Parents\Providers\AuthProvider as ParentAuthProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;
use Laravel\Passport\RouteRegistrar;

/**
 * This class is provided by Laravel as default provider,
 * to register authorization policies.
 *
 * A.K.A App\Providers\AuthServiceProvider.php
 */
class AuthProvider extends ParentAuthProvider
{
    use RoutesLoaderTrait;

    /**
     * Indicates if loading of the provider is deferred.
     */
    protected bool $defer = true;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        $this->registerPassport();
        $this->registerPassportApiRoutes();
        $this->registerPassportWebRoutes();
    }

    private function registerPassport(): void
    {
        if (config('apiato.api.enabled-implicit-grant')) {
            Passport::enableImplicitGrant();
        }

        Passport::tokensExpireIn(Carbon::now()->addMinutes(config('apiato.api.expires-in')));

        Passport::refreshTokensExpireIn(Carbon::now()->addMinutes(config('apiato.api.refresh-expires-in')));
    }

    private function registerPassportApiRoutes(): void
    {
        $prefix = config('apiato.api.prefix');
        $routeGroupArray = $this->getRouteGroup("/{$prefix}v1");

        if (!$this->app->routesAreCached()) {
            Route::group($routeGroupArray, function () {
                Passport::routes(function (RouteRegistrar $router) {
                    $router->forAccessTokens();
                    $router->forTransientTokens();
                    $router->forClients();
                    $router->forPersonalAccessTokens();
                });
            });
        }
    }

    private function registerPassportWebRoutes(): void
    {
        if (!$this->app->routesAreCached()) {
            Passport::routes(function (RouteRegistrar $router) {
                $router->forAuthorization();
            });
        }
    }
}
