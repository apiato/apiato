<?php

namespace App\Port\Loader\Loaders;

use App;
use App\Port\Foundation\Portals\Facade\PortButler;
use DB;
use File;
use Log;

/**
 * Class ProvidersLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait ProvidersLoaderTrait
{

    /**
     * runProvidersAutoLoader
     */
    public function runProvidersAutoLoader()
    {
        $this->loadProvidersFromPort();
        $this->loadProvidersFromContainers();
    }

    /**
     * loadProvidersFromContainers
     */
    private function loadProvidersFromContainers()
    {
        $mainServiceProviderNameStartWith = 'Main';

        foreach (PortButler::getContainersNames() as $containerName) {

            $containerProvidersDirectory = base_path('app/Containers/' . $containerName . '/Providers');

            if (File::isDirectory($containerProvidersDirectory)) {

                $files = \File::allFiles($containerProvidersDirectory);

                foreach ($files as $file) {

                    if (\File::isFile($file)) {

                        // Check if this is the Main Service Provider
                        if (PortButler::stringStartsWith($file->getFilename(), $mainServiceProviderNameStartWith)) {
                            $serviceProviderClass = PortButler::getClassFullNameFromFile($file->getPathname());

                            $this->loadProvider($serviceProviderClass);
                        }
                    }
                }
            }
        }
    }

    /**
     * loadProvidersFromPort
     */
    private function loadProvidersFromPort()
    {
        foreach ($this->serviceProviders as $providerClass) {
            $this->loadProvider($providerClass);
        }
    }

    /*
     * loadProvider
     */
    private function loadProvider($provider)
    {
        App::register($provider);
    }

    /**
     * loadContainersInternalProviders
     */
    public function loadContainersInternalProviders()
    {
        foreach ($this->containerServiceProviders as $provider) {
            $this->loadProvider($provider);
        }
    }
}
