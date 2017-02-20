<?php

namespace App\Containers\User\Providers;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Containers\User\Data\Repositories\UserRepository;
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

    /**
     * Container Service Providers.
     *
     * @var array
     */
    public $serviceProviders = [
        EventsServiceProvider::class,
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

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
