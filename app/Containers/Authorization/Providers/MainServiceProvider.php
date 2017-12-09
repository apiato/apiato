<?php

namespace App\Containers\Authorization\Providers;

use App\Ship\Parents\Providers\MainProvider;
use Spatie\Permission\PermissionServiceProvider;

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
        PermissionServiceProvider::class,
        MiddlewareServiceProvider::class
    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    public $aliases = [

    ];

}
