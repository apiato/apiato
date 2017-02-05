<?php

namespace App\Port\Loader;

use App\Port\Loader\Loaders\AliasesLoaderTrait;
use App\Port\Loader\Loaders\ConfigsLoaderTrait;
use App\Port\Loader\Loaders\ConsolesLoaderTrait;
use App\Port\Loader\Loaders\FactoriesLoaderTrait;
use App\Port\Loader\Loaders\MigrationsLoaderTrait;
use App\Port\Loader\Loaders\ProvidersLoaderTrait;
use App\Port\Loader\Loaders\ViewsLoaderTrait;

/**
 * Class AutoLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait AutoLoaderTrait
{
    use ConfigsLoaderTrait;
    use MigrationsLoaderTrait;
    use ViewsLoaderTrait;
    use ProvidersLoaderTrait;
    use FactoriesLoaderTrait;
    use ConsolesLoaderTrait;
    use AliasesLoaderTrait;

    public function bootLoaders()
    {
        $this->runConfigsAutoLoader();
        $this->runProvidersAutoLoader();
        $this->runMigrationsAutoLoader();
        $this->runViewsAutoLoader();
        $this->runConsolesAutoLoader();
    }

    public function registerLoaders()
    {
        $this->loadPortInternalAliases($this->aliases);
    }


}
