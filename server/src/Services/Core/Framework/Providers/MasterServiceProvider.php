<?php

namespace Mega\Services\Core\Framework\Providers;

use Dingo\Api\Http\Response;
use Mega\Modules\User\Providers\UserServiceProvider;
use Mega\Services\Core\Framework\Abstracts\ServiceProvider;

/**
 * Class MasterServiceProvider
 * The main Service Provider where all Service Providers gets registered
 * this is the only Service Provider that gets injected in the Config/app.php
 *
 * Class MasterServiceProvider
 *
 * @type    (Master) Service Provider
 * @package Mega\Services\Core\Framework\Providers
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class MasterServiceProvider extends ServiceProvider
{

    /**
     * Application Service Provides
     *
     * @var array
     */
    private $serviceProviders = [
        ApiBaseRouteServiceProvider::class,
        // Modules Service Providers:
        UserServiceProvider::class,
        // ...
    ];

    public function boot()
    {
        foreach ($this->serviceProviders as $serviceProvider) {
            $this->app->register($serviceProvider);
        }

        $this->overrideDefaultFractalSerializer();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->changeTheDefaultDatabaseModelsFactoriesPath();
        $this->debugDatabaseQueries(true);
    }

}
