<?php

namespace App\Containers\Authorization\Providers;

use App\Port\Provider\Abstracts\ServiceProviderAbstract;

use Zizaco\Entrust\EntrustFacade;
use Zizaco\Entrust\EntrustServiceProvider;

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
        EntrustServiceProvider::class,
    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    private $containerAliases = [
        'Entrust'    => EntrustFacade::class,
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
