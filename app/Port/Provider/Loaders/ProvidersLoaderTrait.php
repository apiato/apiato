<?php

namespace App\Port\Provider\Loaders;

use App;
use App\Port\Butler\Portals\Facade\PortButler;
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

    protected $portProvidersDirectories = [

    ];

    public function runProvidersAutoLoader()
    {
        $this->loadProvidersFromPort();
        $this->loadProvidersFromContainers();
    }

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

    private function loadProvidersFromPort()
    {
        foreach ($this->serviceProviders as $providerClass) {
            $this->loadProvider($providerClass);
        }
    }

    private function loadProvider($provider)
    {
        App::register($provider);
    }

    public function loadContainersInternalProviders(Array $providers = [])
    {
        foreach ($providers as $provider) {
            $this->loadProvider($provider);
        }
    }
}
