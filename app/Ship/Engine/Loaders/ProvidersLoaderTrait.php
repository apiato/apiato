<?php

namespace App\Ship\Engine\Loaders;

use App;
use App\Ship\Engine\Butlers\Facades\ShipButler;
use App\Ship\Engine\Butlers\Facades\LoaderButler;
use File;

/**
 * Class ProvidersLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait ProvidersLoaderTrait
{

    /**
     * @param $containerName
     */
    public function loadProvidersFromContainers($containerName)
    {
        $containerProvidersDirectory = base_path('app/Containers/' . $containerName . '/Providers');

        $this->loadProviders($containerProvidersDirectory);
    }

    /**
     * loadProvidersFromShip
     */
    public function loadProvidersFromShip()
    {
        foreach ($this->serviceProviders as $providerClass) {
            $this->loadProvider($providerClass);
        }
    }

    /**
     * @param $directory
     */
    private function loadProviders($directory)
    {
        if (File::isDirectory($directory)) {

            $files = File::allFiles($directory);

            $mainServiceProviderNameStartWith = 'Main';

            foreach ($files as $file) {

                if (File::isFile($file)) {

                    // Check if this is the Main Service Provider
                    if (ShipButler::stringStartsWith($file->getFilename(), $mainServiceProviderNameStartWith)) {

                        $serviceProviderClass = LoaderButler::getClassFullNameFromFile($file->getPathname());

                        $this->loadProvider($serviceProviderClass);

                    }
                }
            }
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
