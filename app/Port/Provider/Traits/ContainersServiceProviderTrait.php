<?php

namespace App\Port\Provider\Traits;

use App;

/**
 * Class ContainersServiceProviderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait ContainersServiceProviderTrait
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

    /**
     * @param array $aliases
     */
    public function registerAliases(array $aliases)
    {
        foreach ($aliases as $aliasKey => $aliasValue) {
            if (class_exists($aliasValue)) {
                App::alias($aliasKey, $aliasValue);
            }
        }
    }

}
