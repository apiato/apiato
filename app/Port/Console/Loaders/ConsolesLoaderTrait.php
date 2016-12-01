<?php

namespace App\Port\Console\Loaders;

use App;
use App\Port\Foundation\Portals\Facade\PortButler;
use DB;
use File;

/**
 * Class ConsolesLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait ConsolesLoaderTrait
{

    protected $portConsolesDirectories = [

    ];

    public function runConsolesAutoLoader()
    {
        $this->loadConsolesFromPort();
        $this->loadConsolesFromContainers();
    }

    private function loadConsolesFromContainers()
    {
        $consoleClasses = [];
        foreach (PortButler::getContainersNames() as $containerName) {
            $containerCommandsDirectory = base_path('app/Containers/' . $containerName . '/UI/CLI/Commands/');
            if (File::isDirectory($containerCommandsDirectory)) {
                $files = File::allFiles($containerCommandsDirectory);
                foreach ($files as $consoleFile) {
                    if (File::isFile($consoleFile)) {
                        $pathName = $consoleFile->getPathname();
                        $consoleClasses[] = PortButler::getClassFullNameFromFile($pathName);
                    }
                }
            }
        };

        $this->loadConsoles($consoleClasses);

    }

    private function loadConsolesFromPort()
    {

    }

    private function loadConsoles(array $consoleClasses = [])
    {
        $this->commands($consoleClasses);
    }

}
