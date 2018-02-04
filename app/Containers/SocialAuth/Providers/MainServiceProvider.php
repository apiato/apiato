<?php

namespace App\Containers\SocialAuth\Providers;

use App\Ship\Parents\Providers\MainProvider;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\SocialiteServiceProvider;

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
        SocialiteServiceProvider::class
    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    public $aliases = [
        'Socialite' => Socialite::class,
    ];

    /**
     * Register anything in the container.
     */
    public function register()
    {
        parent::register();

        // do your binding here..
    }
}
