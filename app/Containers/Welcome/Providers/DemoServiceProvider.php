<?php

namespace App\Containers\Welcome\Providers;

use App\Port\Provider\Abstracts\ServiceProviderAbstract;

/**
 * Class WelcomeServiceProvider.
 *
 * The Main Task Provider of this Module.
 * Will be automatically registered in the framework after
 * adding the Module name to containers config file.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class WelcomeServiceProvider extends ServiceProviderAbstract
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Container internal Task Provides.
     *
     * @var array
     */
    private $containerServiceProviders = [
        // ...
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

    }
}
