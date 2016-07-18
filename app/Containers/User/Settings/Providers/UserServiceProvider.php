<?php

namespace App\Containers\User\Settings\Providers;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Containers\User\Settings\Repositories\UserRepository;
use App\Port\Provider\Abstracts\ServiceProviderAbstract;

/**
 * Class UserServiceProvider.
 *
 * The Main Service Provider of this Module.
 * Will be automatically registered in the framework after
 * adding the Module name to containers config file.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserServiceProvider extends ServiceProviderAbstract
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Container internal Service Provides.
     *
     * @var array
     */
    private $containerServiceProviders = [
        PoliciesServiceProvider::class,
        EventsServiceProvider::class,
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
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
