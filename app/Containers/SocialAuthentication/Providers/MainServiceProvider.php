<?php

namespace App\Containers\SocialAuthentication\Providers;

use App\Port\Provider\Abstracts\ServiceProviderAbstract;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\SocialiteServiceProvider;

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
        SocialiteServiceProvider::class,
    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    private $containerAliases = [
        'Socialite' => Socialite::class,
    ];

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->registerServiceProviders($this->containerServiceProviders);
    }

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->registerAliases($this->containerAliases);
    }
}
