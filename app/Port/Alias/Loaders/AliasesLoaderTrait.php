<?php

namespace App\Port\Alias\Loaders;

use App;
use Illuminate\Foundation\AliasLoader;

/**
 * Class AliasesLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait AliasesLoaderTrait
{
    public function loadContainersInternalAliases()
    {
        foreach ($this->containerAliases as $aliasKey => $aliasValue) {
            if (class_exists($aliasValue)) {
                $this->loadAlias($aliasKey, $aliasValue);
            }
        }
    }

    public function loadPortInternalAliases(array $aliases = [])
    {
        foreach ($aliases as $aliasKey => $aliasValue) {
            if (class_exists($aliasValue)) {
                $this->loadAlias($aliasKey, $aliasValue);
            }
        }
    }

    private function loadAlias($aliasKey, $aliasValue)
    {
        AliasLoader::getInstance()->alias($aliasKey, $aliasValue);
    }

}
