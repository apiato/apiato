<?php

namespace Hello\Modules\Demo\Providers;

use Hello\Modules\Core\Provider\Abstracts\ServiceProvider;

/**
 * Class DemoServiceProvider.
 *
 * The Main Service Provider of this Module.
 * Will be automatically registered in the framework after
 * adding the Module name to modules config file.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class DemoServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {

    }

    /**
     * Register bindings in the container.
     */
    public function register()
    {

    }
}
