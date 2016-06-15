<?php

// Automatically include Factory Files from all Modules to this file,
// which will be used by Laravel when dealing with Model Factories.
foreach (App\Services\Configuration\Portals\Facade\ModulesConfig::getModulesNames() as $moduleName) {

    $modulesDirectory = base_path('app/Modules/' . $moduleName . '/Factory/');

    if (is_dir($modulesDirectory)) {
        $moduleFactoryFile = $modulesDirectory . $moduleName . 'Factory.php';

        if (is_file($moduleFactoryFile)) {
            include($moduleFactoryFile);
        }
    }
}

