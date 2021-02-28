<?php

namespace Apiato\Core\Loaders;

use Apiato\Core\Foundation\Facades\Apiato;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

trait ProvidersLoaderTrait
{
    /**
     * Loads only the Main Service Providers from the Containers.
     * All the Service Providers (registered inside the main), will be
     * loaded from the `boot()` function on the parent of the Main
     * Service Providers.
     * @param $containerName
     */
    public function loadOnlyMainProvidersFromContainers($containerName): void
    {
        $containerProvidersDirectory = base_path('app/Containers/' . $containerName . '/Providers');

        $this->loadProviders($containerProvidersDirectory);
    }

    private function loadProviders($directory): void
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

    private function loadProvider($providerFullName): void
    {
        App::register($providerFullName);
    }

    /**
     * Load the all the registered Service Providers on the Main Service Provider.
     */
    public function loadServiceProviders(): void
    {
        foreach ($this->serviceProviders as $provider) {
            $this->loadProvider($provider);
        }
    }
}
