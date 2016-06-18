<?php

// Automatically include Factory Files from all Containers to this file,
// which will be used by Laravel when dealing with Model Factories.
foreach (App\Services\Configuration\Portals\Facade\ContainersConfig::getContainersNames() as $moduleName) {

    $modulesDirectory = base_path('app/Containers/' . $moduleName . '/Factories/');

    if (is_dir($modulesDirectory)) {
        $moduleFactoryFile = $modulesDirectory . $moduleName . 'Factory.php';

        if (is_file($moduleFactoryFile)) {
            include($moduleFactoryFile);
        }
    }
}

