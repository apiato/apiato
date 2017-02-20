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
     * Container Service Providers.
     *
     * @var array
     */
    public $serviceProviders = [
        MiddlewareServiceProvider::class,
    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    public $aliases = [

    ];

    /**
     * Register anything in the container.
     */
    public function register()
    {
        parent::register();

        $this->runQueryDebugger(true, true);
    }
}
