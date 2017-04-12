<?php

namespace App\Ship\Engine\Loaders;

use App;
use App\Ship\Engine\Butlers\Facades\ShipButler;
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
     *
     */
    public function loadConsolesFromShip()
    {
//        $portFolderName = base_path('app/Ship/') . $portFolderName . '/Commands/';

//        $shipFolderNames = [
//            $portFolderName = base_path('Ship/Features/Seeders/Commands/')
//        ];
//
//        foreach ($shipFolderNames as $folder){
//            $this->loadTheConsoles($folder);
//        }
    }

    /**
     * @param $directory
     */
    private function loadTheConsoles($directory)
    {
        if (File::isDirectory($directory)) {

            $files = File::allFiles($directory);

            foreach ($files as $consoleFile) {

                $consoleClass = ShipButler::getClassFullNameFromFile($consoleFile->getPathname());

                // when user from the Main Service Provider, which extends Laravel
                // service provider you get access to `$this->commands`
                $this->commands([$consoleClass]);
            }

        }
    }


}
