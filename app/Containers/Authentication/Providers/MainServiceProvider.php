<?php

namespace App\Containers\Authentication\Providers;

use App\Ship\Parents\Providers\MainProvider;
use Tymon\JWTAuth\Providers\JWTAuthServiceProvider;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Jenssegers\Agent\AgentServiceProvider;
use Jenssegers\Agent\Facades\Agent;

/**
 * Class MainServiceProvider.
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class MainServiceProvider extends MainProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Container Service Providers.
     *
     * @var array
     */
    public $containerServiceProviders = [
        JWTAuthServiceProvider::class,
        AgentServiceProvider::class,
        MiddlewareServiceProvider::class
    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    public $containerAliases = [
        'JWTAuth'    => JWTAuth::class,
        'JWTFactory' => JWTFactory::class,
        'Agent' => Agent::class,
    ];

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->loadContainersInternalProviders();
    }

    /**
     * Register anything in the container.
     */
    public function register()
    {
        $this->loadContainersInternalAliases();
    }
}
