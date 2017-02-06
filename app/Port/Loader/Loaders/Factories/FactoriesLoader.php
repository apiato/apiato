<?php

/**
 * This files acts as the single factory php file of all the application.
 * Inside this file I am including every factory file found int he application.
 *
 * This currently only load factories from containers not form the port as it's not necessary yet!
 */

// Default seeders directory in the container
use App\Port\Loader\Helpers\Facade\LoaderHelper;

$containersFactoriesPath = '/Data/Factories/';

// Automatically include Factory Files from all Containers to this file,
// which will be used by Laravel when dealing with Model Factories.
foreach (LoaderHelper::getContainersNames() as $containerName) {

    $containersDirectory = base_path('app/Containers/' . $containerName . $containersFactoriesPath);

    if (\File::isDirectory($containersDirectory)) {

        $files = \File::allFiles($containersDirectory);

        foreach ($files as $factoryFile) {

            if (\File::isFile($factoryFile)) {

                // Include the factory files
                include($factoryFile);

            }

        }

    }
}

