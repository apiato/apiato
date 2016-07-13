<?php

namespace App\Port\Views\Traits;

use App\Port\Butler\Portals\PortButler;
use Illuminate\View\Factory as View;

/**
 * Class ViewsTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait ViewsTrait
{
    /**
     * Automatically load all the containers views directories.
     * To be used by the Web Controller Abstract Class.
     */
    private function loadContainersViewsDirectories(View $view, PortButler $portButler)
    {
        foreach ($portButler->getContainersNames() as $containerName) {
            $containerViewDirectory = base_path('app/Containers/' . $containerName . '/Views/');
            if (is_dir($containerViewDirectory)) {
                $view->addLocation($containerViewDirectory);
            }
        }

    }
}
