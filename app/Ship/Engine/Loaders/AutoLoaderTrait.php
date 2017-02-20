<?php

namespace App\Ship\Engine\Loaders;

use App\Ship\Engine\Butlers\Facades\ShipButler;

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
    public function runLoadersBoot()
    {
        // the config files should be loaded first from all the directories in their own loop
        $this->loadConfigsFromShip();
        $this->loadProvidersFromShip();

        // > iterate over all the port folders and autoload most of the components
        foreach (ShipButler::getShipFoldersNames() as $portFolderName) {
            $this->loadMigrationsFromShip();
            $this->loadViewsFromShip($portFolderName);
        }

        // > iterate over all the containers folders and autoload most of the components
        foreach (ShipButler::getContainersNames() as $containerName) {
            $this->loadConfigsFromContainers($containerName);
            $this->loadProvidersFromContainers($containerName);
            $this->loadMigrationsFromContainers($containerName);
            $this->loadViewsFromContainers($containerName);
            $this->loadViewsFromShip($containerName);
            $this->loadConsolesFromContainers($containerName);
        }
    }

    /**
     * to be used from the `register` function of the main service provider
     */
    public function runLoadersRegister()
    {
        $this->loadContainerFactories();
        $this->loadShipInternalAliases();
    }

}
