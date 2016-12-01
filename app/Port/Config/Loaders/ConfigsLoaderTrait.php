<?php

namespace App\Port\Config\Loaders;

use App;
use App\Port\Butler\Portals\Facade\PortButler;
use DB;
use File;
use Log;

/**
 * Class ConfigsLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait ConfigsLoaderTrait
{

    /**
     * Auto load Containers and Port config files into Laravel
     */
    public function autoLoadConfigFiles()
    {
        $this->autoLoadContainersConfigFiles();
        $this->autoLoadPortConfigFiles();
    }

    protected function autoLoadContainersConfigFiles()
    {
        foreach (PortButler::getContainersNames() as $containerName) {
            $this->loadConfigs(base_path('app/Containers/' . $containerName . '/Configs'));
        }
    }

    protected function autoLoadPortConfigFiles()
    {
        $this->loadConfigs(base_path('app/Port/Config/Configs'));
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
