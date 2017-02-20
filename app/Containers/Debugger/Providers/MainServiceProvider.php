<?php

namespace App\Containers\Debugger\Providers;

use App\Containers\Debugger\Traits\QueryDebuggerTrait;
use App\Ship\Parents\Providers\MainProvider;

/**
 * Class MainServiceProvider.
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class MainServiceProvider extends MainProvider
{
    use QueryDebuggerTrait;
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
        MiddlewareServiceProvider::class,
    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    public $containerAliases = [

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

        $this->runQueryDebugger(true, true);
    }
}
