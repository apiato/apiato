<?php

namespace Apiato\Core\Loaders;

use File;

/**
 * Class ConfigsLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait ConfigsLoaderTrait
{

    /**
     * @param $containerName
     */
    public function loadConfigsFromContainers($containerName)
    {
        $containerConfigsDirectory = base_path('app/Containers/' . $containerName . '/Configs');

        $this->loadConfigs($containerConfigsDirectory);
    }

    /**
     *
     */
    public function loadConfigsFromShip()
    {
        $portConfigsDirectory = base_path('app/Ship/Configs');

        $this->loadConfigs($portConfigsDirectory);
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
