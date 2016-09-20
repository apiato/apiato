<?php

namespace App\Port\Provider\Traits;

use App;

/**
 * Class AutoRegisterServiceProvidersTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait AutoRegisterServiceProvidersTrait
{

    /**
     * register an array of providers.
     *
     * @param array $providers
     */
    public function registerServiceProviders(array $providers)
    {
        foreach ($providers as $provider) {
            if (class_exists($provider)) {
                App::register($provider);
            }
        }
    }

}
