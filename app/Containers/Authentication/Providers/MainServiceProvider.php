<?php

namespace App\Containers\Authentication\Providers;

use App\Port\Provider\Abstracts\ServiceProviderAbstract;
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
class MainServiceProvider extends ServiceProviderAbstract
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
    private $containerServiceProviders = [
        JWTAuthServiceProvider::class,
        AgentServiceProvider::class,
    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    private $containerAliases = [
        'JWTAuth'    => JWTAuth::class,
        'JWTFactory' => JWTFactory::class,
        'Agent' => Agent::class,
    ];

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->registerServiceProviders($this->containerServiceProviders);
    }

    /**
     * Register anything in the container.
     */
    public function register()
    {
        $this->registerAliases($this->containerAliases);
    }
}
