<?php

namespace Mega\Modules\User\Providers;

use Mega\Services\Core\Framework\Abstracts\ServiceProvider;
use Mega\Modules\User\Contracts\UserRepositoryInterface;
use Mega\Modules\User\Repositories\Eloquent\UserRepository;

/**
 * Class UserServiceProvider
 *
 * @type    Service Provider
 * @package Mega\Modules\User\Providers
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
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->register(RoutesServiceProvider::class);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->registerTheDatabaseMigrationsFiles(__DIR__);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

}
