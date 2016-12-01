<?php

// Default seeders directory in the container
$factoriesPath = '/Data/Factories/';

// Automatically include Factory Files from all Containers to this file,
// which will be used by Laravel when dealing with Model Factories.
foreach (App\Port\Butler\Portals\Facade\PortButler::getContainersNames() as $containerName) {

    $containersDirectory = base_path('app/Containers/' . $containerName . $factoriesPath);

    if (\File::isDirectory($containersDirectory)) {

        $files = \File::allFiles($containersDirectory);

        foreach ($files as $factoryFile) {

            if (\File::isFile($factoryFile)) {
                include($factoryFile);
            }

        }

    }
}

