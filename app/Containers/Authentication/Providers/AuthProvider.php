<?php

namespace App\Containers\Authentication\Providers;

use Apiato\Core\Loaders\RoutesLoaderTrait;
use App\Ship\Parents\Providers\AuthProvider as ParentAuthProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Laravel\Passport\Passport;
use Laravel\Passport\RouteRegistrar;
use Route;

/**
 * Class ShipAuthServiceProvider
 *
 * This class is provided by Laravel as default provider,
 * to register authorization policies.
 *
 * A.K.A App\Providers\AuthServiceProvider.php
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class AuthProvider extends ParentAuthProvider
{
    use RoutesLoaderTrait;

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->registerPassport();
        $this->registerPassportApiRoutes();
        $this->registerPassportWebRoutes();
    }

    /**
     * Register password.
     * 
     * @return void
     */
    private function registerPassport()
    {
        if (Config::get('apiato.api.enabled-implicit-grant')) {
            Passport::enableImplicitGrant();
        }

        Passport::tokensExpireIn(Carbon::now()->addMinutes(Config::get('apiato.api.expires-in')));

        Passport::refreshTokensExpireIn(Carbon::now()->addMinutes(Config::get('apiato.api.refresh-expires-in')));
    }

    /**
     * Register password api routes.
     * 
     * @return void
     */
    private function registerPassportApiRoutes()
    {
        $prefix = Config::get('apiato.api.prefix');
        $routeGroupArray = $this->getRouteGroup("/{$prefix}v1");

        Route::group($routeGroupArray, function () {
            Passport::routes(function (RouteRegistrar $router) {
                $router->forAccessTokens();
                $router->forTransientTokens();
                $router->forClients();
                $router->forPersonalAccessTokens();
            });
        });
    }

    /**
     * Register password web routes.
     * 
     * @return void
     */
    private function registerPassportWebRoutes()
    {
        Passport::routes(function (RouteRegistrar $router) {
            $router->forAuthorization();
        });
    }
}
