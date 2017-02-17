<?php

namespace App\Port\Loader\Loaders;

use File;
use Illuminate\Support\Facades\View;

/**
 * Class ViewsLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait ViewsLoaderTrait
{

    /**
     * loadViewsFromContainers
     */
    public function loadViewsFromContainers($containerName)
    {
        $containerViewDirectory = base_path('app/Containers/' . $containerName . '/UI/WEB/Views/');

        $this->loadViews($containerViewDirectory, $containerName);
    }

    /**
     * @param $portFolderName
     */
    public function loadViewsFromPort($portFolderName)
    {
        // TODO: Never Tested

        $portViewsDirectory = base_path('app/Port/') . $portFolderName . '/Views/';

        $this->loadViews($portViewsDirectory);
    }

    /**
     * @param $directory
     */
    private function loadViews($directory, string $containerName = '')
    {
        if (File::isDirectory($directory)) {
            empty($containerName)
                ? View::addLocation($directory)
                : View::addNamespace(camel_case($containerName), $directory);
        }
    }

}
