<?php

namespace App\Containers\Wepay\Providers;

use App\Ship\Parents\Providers\MainProvider;
use KevinEm\WePay\Laravel\Facades\WePayLaravel;
use KevinEm\WePay\Laravel\Providers\WePayServiceProvider;

/**
 * Class MainServiceProvider.
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 *
 * @author  Rockers Technologies <jaimin.rockersinfo@gmail.com>
 */
class MainServiceProvider extends MainProvider
{

    /**
     * Container Service Providers.
     *
     * @var array
     */
    public $serviceProviders = [
        WePayServiceProvider::class,
    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    public $aliases = [
        'Wepay' => WePayLaravel::class,
    ];

}
