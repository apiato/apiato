<?php

namespace App\Ship\Loader\Loaders;

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
    public function loadPortInternalAliases()
    {
        // `$this->aliases` is declared on the Main Service Provider of the Port layer
        foreach (isset($this->aliases) ? $this->aliases : [] as $aliasKey => $aliasValue) {
            if (class_exists($aliasValue)) {
                $this->loadAlias($aliasKey, $aliasValue);
            }
        }
    }

    /**
     * loadContainersInternalAliases
     */
    public function loadContainersInternalAliases()
    {
        // `$this->aliases` is declared on each Container's Main Service Provider
        foreach (isset($this->containerAliases) ? $this->containerAliases : [] as $aliasKey => $aliasValue) {
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
}
