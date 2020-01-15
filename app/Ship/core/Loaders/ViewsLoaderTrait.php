<?php

namespace Apiato\Core\Loaders;

use File;

/**
 * Class ViewsLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait ViewsLoaderTrait
{

    /**
     * @param $containerName
     */
    public function loadViewsFromContainers($containerName)
    {
        $containerViewDirectory = base_path('app/Containers/' . $containerName . '/UI/WEB/Views/');
        $containerMailTemplatesDirectory = base_path('app/Containers/' . $containerName . '/Mails/Templates/');

        $this->loadViews($containerViewDirectory, $containerName);
        $this->loadViews($containerMailTemplatesDirectory, $containerName);
    }

    /**
     * @param void
     */
    public function loadViewsFromShip()
    {
        $portMailTemplatesDirectory = base_path('app/Ship/Mails/Templates/');

        $this->loadViews($portMailTemplatesDirectory, 'ship'); // Ship views accessible via `ship::`.
    }

    /**
     * @param $directory
     * @param $containerName
     */
    private function loadViews($directory, $containerName)
    {
        if (File::isDirectory($directory)) {
            $this->loadViewsFrom($directory, strtolower($containerName));
        }
    }

}
