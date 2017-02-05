<?php

namespace App\Port\Loader\Loaders;

use App;
use Illuminate\Foundation\AliasLoader;

/**
 * Class AliasesLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait AliasesLoaderTrait
{

    /**
     * @param array $aliases
     */
    public function loadPortInternalAliases(array $aliases = [])
    {
        foreach ($aliases as $aliasKey => $aliasValue) {
            if (class_exists($aliasValue)) {
                $this->loadAlias($aliasKey, $aliasValue);
            }
        }
    }

    /**
     * @param $aliasKey
     * @param $aliasValue
     */
    private function loadAlias($aliasKey, $aliasValue)
    {
        AliasLoader::getInstance()->alias($aliasKey, $aliasValue);
    }

    /**
     * loadContainersInternalAliases
     */
    public function loadContainersInternalAliases()
    {
        foreach ($this->containerAliases as $aliasKey => $aliasValue) {
            if (class_exists($aliasValue)) {
                $this->loadAlias($aliasKey, $aliasValue);
            }
        }
    }
}
