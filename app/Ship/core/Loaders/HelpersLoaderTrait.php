<?php

namespace Apiato\Core\Loaders;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;

trait HelpersLoaderTrait
{
    public function loadHelpersFromContainers($containerName): void
    {
        $containerHelpersDirectory = base_path('app/Containers/' . $containerName . '/Helpers');

        $this->loadHelpers($containerHelpersDirectory);
    }

    private function loadHelpers($helpersFolder): void
    {
        if (File::isDirectory($helpersFolder)) {
            $files = File::files($helpersFolder);

            foreach ($files as $file) {
                try {
                    require($file);
                } catch (FileNotFoundException $e) {
                }
            }
        }
    }

    public function loadHelpersFromShip(): void
    {
        $shipHelpersDirectory = base_path('app/Ship/Helpers');

        $this->loadConfigs($shipHelpersDirectory);
    }
}
