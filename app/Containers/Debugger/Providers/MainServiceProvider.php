<?php

namespace App\Containers\Debugger\Providers;

use App\Containers\Debugger\Tasks\QueryDebuggerTask;
use App\Ship\Parents\Providers\MainProvider;
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
     * Container Service Providers.
     *
     * @var array
     */
    public $serviceProviders = [
        AgentServiceProvider::class,
        MiddlewareServiceProvider::class,
    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    public $aliases = [
        'Agent' => Agent::class,
    ];

    /**
     * Register anything in the container.
     */
    public function register()
    {
        parent::register();

        (new QueryDebuggerTask)->run();
    }
}
