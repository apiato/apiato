<?php

namespace App\Port\Loader\Loaders;

use App;
use App\Port\Foundation\Portals\Facade\PortButler;
use DB;
use File;
use Illuminate\Support\Facades\View;
use Log;

/**
 * Class ViewsLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait ViewsLoaderTrait
{

    /**
     * runViewsAutoLoader
     */
    public function runViewsAutoLoader()
    {
        $this->loadViewsFromPort();
        $this->loadViewsFromContainers();
    }

    /**
     * loadViewsFromContainers
     */
    private function loadViewsFromContainers()
    {
        foreach (PortButler::getContainersNames() as $containerName) {

            $containerViewDirectory = base_path('app/Containers/' . $containerName . '/UI/WEB/Views/');

            if (File::isDirectory($containerViewDirectory)) {
                $this->loadViews($containerViewDirectory);
            }
        }
    }

    /**
     * @param $directory
     */
    private function loadViews($directory)
    {
        View::addLocation($directory);
    }

    /**
     * loadViewsFromPort
     */
    private function loadViewsFromPort()
    {
        // TODO: Implement this function when needed

        // defined on the Main Service Provider
        $this->portViewsDirectories;
    }
}
