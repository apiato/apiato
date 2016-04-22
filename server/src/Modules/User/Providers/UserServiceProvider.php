<?php

namespace Mega\Modules\User\Providers;

use Mega\Modules\User\Contracts\UserRepositoryInterface;
use Mega\Modules\User\Repositories\Eloquent\UserRepository;
use Mega\Services\Core\Framework\Abstracts\ServiceProvider;

/**
 * Class UserServiceProvider.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Module Service providers to be registered
     *
     * @var array
     */
    protected $providers = [
        RoutesServiceProvider::class,
        AuthServiceProvider::class,
    ];

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->registerServiceProviders($this->providers);
    }

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->registerTheDatabaseMigrationsFiles(__DIR__);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
