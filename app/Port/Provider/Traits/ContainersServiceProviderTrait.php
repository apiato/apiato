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
