<?php

namespace App\Ship\Loader;

use App\Ship\Loader\Helpers\Facade\LoaderHelper;
use App\Ship\Loader\Loaders\AliasesLoaderTrait;
use App\Ship\Loader\Loaders\ConfigsLoaderTrait;
use App\Ship\Loader\Loaders\ConsolesLoaderTrait;
use App\Ship\Loader\Loaders\MigrationsLoaderTrait;
use App\Ship\Loader\Loaders\ProvidersLoaderTrait;
use App\Ship\Loader\Loaders\ViewsLoaderTrait;

/**
 * Class AutoLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait AutoLoaderTrait
{

    // using each component loader trait
    use ConfigsLoaderTrait;
    use MigrationsLoaderTrait;
    use ViewsLoaderTrait;
    use ProvidersLoaderTrait;
    use ConsolesLoaderTrait;
    use AliasesLoaderTrait;

    /**
     * * to be used from the `boot` function of the main service provider
     */
    public function bootLoaders()
    {
        // the config files should be loaded first from all the directories in their own loop
        foreach (LoaderHelper::getShipFoldersNames() as $portFolderName) {
            $this->loadConfigsFromShip($portFolderName); // TODO: move this to the loop below at the top
        }

        $this->loadProvidersFromShip();

        // > iterate over all the port folders and autoload most of the components
        foreach (LoaderHelper::getShipFoldersNames() as $portFolderName) {
            $this->loadMigrationsFromShip($portFolderName);
            $this->loadViewsFromShip($portFolderName);
            $this->loadConsolesFromShip($portFolderName);
        }

        // > iterate over all the containers folders and autoload most of the components
        foreach (LoaderHelper::getContainersNames() as $containerName) {
            $this->loadConfigsFromContainers($containerName);
            $this->loadProvidersFromContainers($containerName);
            $this->loadMigrationsFromContainers($containerName);
            $this->loadViewsFromContainers($containerName);
            $this->loadViewsFromContainers($containerName);
            $this->loadConsolesFromContainers($containerName);
        }
    }

    /**
     * to be used from the `register` function of the main service provider
     */
    public function registerLoaders()
    {
        $this->loadContainerFactories();
        $this->loadShipInternalAliases();
    }

}
