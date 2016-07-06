<?php

namespace App\Ship\Views\Traits;

use App\Ship\Butler\Portals\KernelButler;
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
    private function loadContainersViewsDirectories(View $view, KernelButler $containersConfig)
    {
        foreach ($containersConfig->getContainersNames() as $containerName) {
            $containerViewDirectory = base_path('app/Containers/' . $containerName . '/Views/');
            if (is_dir($containerViewDirectory)) {
                $view->addLocation($containerViewDirectory);
            }
        }

    }
}
