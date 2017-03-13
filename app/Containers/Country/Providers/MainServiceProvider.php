<?php

namespace App\Containers\Country\Providers;

use App\Ship\Parents\Providers\MainProvider;
use Webpatser\Countries\CountriesFacade;
use Webpatser\Countries\CountriesServiceProvider;

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
        CountriesServiceProvider::class,
    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    public $aliases = [
        'Countries' => CountriesFacade::class,
    ];

}
