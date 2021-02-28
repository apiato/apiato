<?php

namespace Apiato\Core\Loaders;

use App;
use Illuminate\Foundation\AliasLoader;

trait AliasesLoaderTrait
{
    public function loadAliases(): void
    {
        // `$this->aliases` is declared on each Container's Main Service Provider
        foreach (isset($this->aliases) ? $this->aliases : [] as $aliasKey => $aliasValue) {
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
