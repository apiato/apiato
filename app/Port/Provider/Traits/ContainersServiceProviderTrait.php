<?php

namespace App\Port\Provider\Traits;

use App;
use Illuminate\Foundation\AliasLoader;

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
                AliasLoader::getInstance()->alias($aliasKey, $aliasValue);
            }
        }
    }

}
