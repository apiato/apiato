<?php

namespace Hello\Modules\User\Providers;

use Hello\Modules\User\Contracts\UserRepositoryInterface;
use Hello\Modules\User\Repositories\Eloquent\UserRepository;
use Hello\Modules\Core\Providers\Abstracts\ServiceProvider;

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

    }

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
