<?php

namespace App\Engine\Views\Traits;

use App\Services\Configuration\Portals\MegavelConfigReaderService;
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
    private function loadContainersViewsDirectories(View $view, MegavelConfigReaderService $containersConfig)
    {
        foreach ($containersConfig->getContainersNames() as $moduleName) {
            $moduleViewDirectory = base_path('app/Containers/' . $moduleName . '/Views/');
            if (is_dir($moduleViewDirectory)) {
                $view->addLocation($moduleViewDirectory);
            }
        }

    }
}
