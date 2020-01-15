<?php

namespace Apiato\Core\Loaders;

use Apiato\Core\Foundation\Facades\Apiato;
use App;
use File;

/**
 * Class ProvidersLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait ProvidersLoaderTrait
{

    /**
     * Loads only the Main Service Providers from the Containers.
     * All the Service Providers (registered inside the main), will be
     * loaded from the `boot()` function on the parent of the Main
     * Service Providers.
     *
     * @param $containerName
     */
    public function loadOnlyMainProvidersFromContainers($containerName)
    {
        $containerProvidersDirectory = base_path('app/Containers/' . $containerName . '/Providers');

        $this->loadProviders($containerProvidersDirectory);
    }

    /**
     * @param $directory
     */
    private function loadProviders($directory)
    {
        $mainServiceProviderNameStartWith = 'Main';

        if (File::isDirectory($directory)) {

            $files = File::allFiles($directory);

            foreach ($files as $file) {

                if (File::isFile($file)) {

                    // Check if this is the Main Service Provider
                    if (Apiato::stringStartsWith($file->getFilename(), $mainServiceProviderNameStartWith)) {

                        $serviceProviderClass = Apiato::getClassFullNameFromFile($file->getPathname());

                        $this->loadProvider($serviceProviderClass);
                    }
                }
            }
        }
    }

    /**
     * @param $providerFullName
     */
    private function loadProvider($providerFullName)
    {
        App::register($providerFullName);
    }

    /**
     * Load the all the registered Service Providers on the Main Service Provider.
     *
     * @void
     */
    public function loadServiceProviders()
    {
        foreach ($this->serviceProviders as $provider) {
            $this->loadProvider($provider);
        }
    }

}
