<?php

namespace App\Port\Loader;

use App\Port\Loader\Helpers\Facade\LoaderHelper;
use App\Port\Loader\Loaders\AliasesLoaderTrait;
use App\Port\Loader\Loaders\ConfigsLoaderTrait;
use App\Port\Loader\Loaders\ConsolesLoaderTrait;
use App\Port\Loader\Loaders\MigrationsLoaderTrait;
use App\Port\Loader\Loaders\ProvidersLoaderTrait;
use App\Port\Loader\Loaders\ViewsLoaderTrait;
use App\Port\Loader\Loaders\TranslationsLoaderTrait;

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
    use TranslationsLoaderTrait;

    /**
     * * to be used from the `boot` function of the main service provider
     */
    public function bootLoaders()
    {
        // the config files should be loaded first from all the directories in their own loop
        foreach (LoaderHelper::getPortFoldersNames() as $portFolderName) {
            $this->loadConfigsFromPort($portFolderName); // TODO: move this to the loop below at the top
        }

        $this->loadProvidersFromPort();

        // > iterate over all the port folders and autoload most of the components
        foreach (LoaderHelper::getPortFoldersNames() as $portFolderName) {
            $this->loadMigrationsFromPort($portFolderName);
            $this->loadViewsFromPort($portFolderName);
            $this->loadConsolesFromPort($portFolderName);
        }

        // > iterate over all the containers folders and autoload most of the components
        foreach (LoaderHelper::getContainersNames() as $containerName) {
            $this->loadConfigsFromContainers($containerName);
            $this->loadProvidersFromContainers($containerName);
            $this->loadMigrationsFromContainers($containerName);
            $this->loadViewsFromContainers($containerName);
            $this->loadTranslationsFromContainers($containerName);
            $this->loadConsolesFromContainers($containerName);
        }
    }

    /**
     * to be used from the `register` function of the main service provider
     */
    public function registerLoaders()
    {
        $this->loadContainerFactories();
        $this->loadPortInternalAliases();
    }

}
