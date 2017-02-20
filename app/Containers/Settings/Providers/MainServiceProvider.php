<?php

namespace App\Containers\Settings\Providers;

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

    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    public $aliases = [

    ];

}
