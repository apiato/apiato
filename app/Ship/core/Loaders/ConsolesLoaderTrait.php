<?php

namespace Apiato\Core\Loaders;

use Apiato\Core\Foundation\Facades\Apiato;
use Illuminate\Support\Facades\File;

trait ConsolesLoaderTrait
{
    public function loadConsolesFromContainers($containerName): void
    {
        $containerCommandsDirectory = base_path('app/Containers/' . $containerName . '/UI/CLI/Commands');

        $this->loadTheConsoles($containerCommandsDirectory);
    }

    private function loadTheConsoles($directory): void
    {
        if (File::isDirectory($directory)) {

            $files = File::allFiles($directory);

            foreach ($files as $consoleFile) {

                // do not load route files
                if (!$this->isRouteFile($consoleFile)) {
                    $consoleClass = Apiato::getClassFullNameFromFile($consoleFile->getPathname());

                    // when user from the Main Service Provider, which extends Laravel
                    // service provider you get access to `$this->commands`
                    $this->commands([$consoleClass]);
                }
            }

        }
    }

    private function isRouteFile($consoleFile): bool
    {
        return $consoleFile->getFilename() === "Routes.php";
    }

    public function loadConsolesFromShip(): void
    {
        $commandsFoldersPaths = [
            // ship commands
            base_path('app/Ship/Commands'),
            // core commands
            __DIR__ . '/../Commands'
        ];

        foreach ($commandsFoldersPaths as $folderPath) {
            $this->loadTheConsoles($folderPath);
        }
    }
}
