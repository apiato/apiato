<?php

namespace App\Ship\Engine\Loaders;

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

        $this->loadViews($containerViewDirectory, $containerName);
    }

    /**
     * @param void
     */
    public function loadViewsFromShip()
    {
        // ..
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
