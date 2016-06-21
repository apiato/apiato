<?php

// Automatically include Factory Files from all Containers to this file,
// which will be used by Laravel when dealing with Model Factories.
foreach (App\Kernel\Configuration\Portals\Facade\MegavelConfig::getContainersNames() as $moduleName) {

    $containersDirectory = base_path('app/Containers/' . $moduleName . '/Factories/');

    if (is_dir($containersDirectory)) {
        $moduleFactoryFile = $containersDirectory . $moduleName . 'Factory.php';

        if (is_file($moduleFactoryFile)) {
            include($moduleFactoryFile);
        }
    }
}

