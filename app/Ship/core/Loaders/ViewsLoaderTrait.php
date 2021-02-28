<?php

namespace Apiato\Core\Loaders;

use Illuminate\Support\Facades\File;

trait ViewsLoaderTrait
{
    public function loadViewsFromContainers($containerName): void
    {
        $containerViewDirectory = base_path('app/Containers/' . $containerName . '/UI/WEB/Views/');
        $containerMailTemplatesDirectory = base_path('app/Containers/' . $containerName . '/Mails/Templates/');

        $this->loadViews($containerViewDirectory, $containerName);
        $this->loadViews($containerMailTemplatesDirectory, $containerName);
    }

    private function loadViews($directory, $containerName): void
    {
        if (File::isDirectory($directory)) {
            $this->loadViewsFrom($directory, strtolower($containerName));
        }
    }

    public function loadViewsFromShip(): void
    {
        $portMailTemplatesDirectory = base_path('app/Ship/Mails/Templates/');

        $this->loadViews($portMailTemplatesDirectory, 'ship'); // Ship views accessible via `ship::`.
    }
}
