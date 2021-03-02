<?php

namespace App\Containers\Debugger\Providers;

use App\Containers\Debugger\Tasks\QueryDebuggerTask;
use App\Ship\Parents\Providers\MainProvider;
use Barryvdh\Debugbar\Facade as Debugbar;
use Barryvdh\Debugbar\ServiceProvider as DebugbarServiceProvider;
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
     */
    public array $serviceProviders = [
        AgentServiceProvider::class,
        MiddlewareServiceProvider::class,
        DebugbarServiceProvider::class
    ];

    /**
     * Container Aliases
     */
    public array $aliases = [
        'Agent' => Agent::class,
        'Debugbar' => Debugbar::class,
    ];

    /**
     * Register anything in the container.
     */
    public function register(): void
    {
        parent::register();

        (new QueryDebuggerTask)->run();
    }
}
