<?php

namespace App\Port\Loader\Loaders;

use App;
use App\Port\Loader\Helpers\Facade\LoaderHelper;
use DB;
use File;

/**
 * Class ConsolesLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait ConsolesLoaderTrait
{

    /**
     * @param $containerName
     */
    public function loadConsolesFromContainers($containerName)
    {
        $containerCommandsDirectory = base_path('app/Containers/' . $containerName . '/UI/CLI/Commands/');

        $this->loadConsoles($containerCommandsDirectory);
    }

    /**
     * @param $portFolderName
     */
    public function loadConsolesFromPort($portFolderName)
    {
        // TODO: Never Tested

        $portFolderName = base_path('app/Port/') . $portFolderName . '/Commands/';

        $this->loadConsoles($portFolderName);
    }

    /**
     * @param $consoleClass
     */
    private function loadConsoles($directory)
    {
        if (File::isDirectory($directory)) {

            $files = File::allFiles($directory);

            foreach ($files as $consoleFile) {

                $consoleClass = LoaderHelper::getClassFullNameFromFile($consoleFile->getPathname());

                // when user from the Main Service Provider, which extends Laravel
                // service provider you get access to `$this->commands`
                $this->commands([$consoleClass]);
            }

        }
    }


}
