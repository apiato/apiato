<?php

namespace App\Ship\Loader\Loaders;

use App;
use App\Ship\Loader\Helpers\Facade\LoaderHelper;
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

        $this->loadTheConsoles($containerCommandsDirectory);
    }

    /**
     * @param $portFolderName
     */
    public function loadConsolesFromPort($portFolderName)
    {
        // TODO: Never Tested

        $portFolderName = base_path('app/Ship/') . $portFolderName . '/Commands/';

        $this->loadTheConsoles($portFolderName);
    }

    /**
     * @param $consoleClass
     */
    private function loadTheConsoles($directory)
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
