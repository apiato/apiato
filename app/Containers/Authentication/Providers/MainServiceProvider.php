<?php

namespace App\Containers\Authentication\Providers;

use App\Ship\Parents\Providers\MainProvider;
use Jenssegers\Agent\AgentServiceProvider;
use Jenssegers\Agent\Facades\Agent;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Providers\JWTAuthServiceProvider;

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
     * Container Service Providers.
     *
     * @var array
     */
    public $serviceProviders = [
        JWTAuthServiceProvider::class,
        AgentServiceProvider::class,
        MiddlewareServiceProvider::class
    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    public $aliases = [
        'JWTAuth'    => JWTAuth::class,
        'JWTFactory' => JWTFactory::class,
        'Agent'      => Agent::class,
    ];

}
