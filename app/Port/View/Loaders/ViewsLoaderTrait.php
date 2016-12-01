<?php

namespace App\Port\View\Loaders;

use App;
use App\Port\Butler\Portals\Facade\PortButler;
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

    protected $portViewsDirectories = [

    ];

    public function runViewsAutoLoader()
    {
        $this->loadViewsFromPort();
        $this->loadViewsFromContainers();
    }

    private function loadViewsFromContainers()
    {
        foreach (PortButler::getContainersNames() as $containerName) {

            $containerViewDirectory = base_path('app/Containers/' . $containerName . '/UI/WEB/Views/');

            if (File::isDirectory($containerViewDirectory)) {
                $this->loadViews($containerViewDirectory);
            }
        }
    }

    private function loadViewsFromPort()
    {

    }

    private function loadViews($directory)
    {
        View::addLocation($directory);
    }
}
