<?php

// Automatically include Factory Files from all Containers to this file,
// which will be used by Laravel when dealing with Model Factories.
foreach (App\Kernel\Butler\Portals\Facade\KernelButler::getContainersNames() as $containerName) {

    $containersDirectory = base_path('app/Containers/' . $containerName . '/Factories/');

    if (is_dir($containersDirectory)) {
        $containerFactoryFile = $containersDirectory . $containerName . 'Factory.php';

        if (is_file($containerFactoryFile)) {
            include($containerFactoryFile);
        }
    }
}

