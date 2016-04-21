<?php

namespace Mega\Modules\User\Providers;

use Mega\Services\Core\Framework\Abstracts\ServiceProvider;
use Mega\Modules\User\Contracts\UserRepositoryInterface;
use Mega\Modules\User\Repositories\Eloquent\UserRepository;

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
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->app->register(RoutesServiceProvider::class);
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
