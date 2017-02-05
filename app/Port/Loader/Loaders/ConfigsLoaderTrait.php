<?php

namespace App\Port\Loader\Loaders;

use App;
use App\Port\Foundation\Portals\Facade\PortButler;
use DB;
use File;

/**
 * Class ConfigsLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait ConfigsLoaderTrait
{

    /**
     * runConfigsAutoLoader
     */
    public function runConfigsAutoLoader()
    {
        $this->loadConfigsFromPort();
        $this->loadConfigsFromContainers();
    }

    /**
     * loadConfigsFromContainers
     */
    private function loadConfigsFromContainers()
    {
        foreach (PortButler::getContainersNames() as $containerName) {
            $this->loadConfigs(base_path('app/Containers/' . $containerName . '/Configs'));
        }
    }

    /**
     * loadConfigsFromPort
     */
    private function loadConfigsFromPort()
    {
        // $this->portConfigsDirectories is defined on the main service provider class
        foreach ($this->portConfigsDirectories as $portConfigsDirectory) {
            $this->loadConfigs(base_path('app/Port/') . $portConfigsDirectory);
        }
    }

    /**
     * @param $directory
     */
    private function loadConfigs($directory)
    {
        if (File::isDirectory($directory)) {

            $files = File::allFiles($directory);

            foreach ($files as $file) {
                // build the key from the file name (just remove the .php extension from the file name)
                $fileNameOnly = str_replace('.php', '', $file->getFilename());

                // merge the config file
                $this->mergeConfigFrom($file->getPathname(), $fileNameOnly);
            }
        }
    }
}
