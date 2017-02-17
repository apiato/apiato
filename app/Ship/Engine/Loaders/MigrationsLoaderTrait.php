<?php

namespace App\Ship\Engine\Loaders;

use App;
use File;

/**
 * Class MigrationsLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait MigrationsLoaderTrait
{

    /**
     * @param $containerName
     */
    public function loadMigrationsFromContainers($containerName)
    {
        $containerMigrationDirectory = base_path('app/Containers/' . $containerName . '/Data/Migrations');

        $this->loadMigrations($containerMigrationDirectory);
    }

    /**
     * @void
     */
    public function loadMigrationsFromShip()
    {
        // TODO: Currently only the Queue Migration will work since this is statically defined.
        // Need to Loop over that Directory and load the any Migration file there.
        $portMigrationDirectory = base_path('app/Ship/Features/Migrations/Queue');

        $this->loadMigrations($portMigrationDirectory);
    }

    /**
     * @param $directory
     */
    private function loadMigrations($directory)
    {
        if (File::isDirectory($directory)) {

            App::afterResolving('migrator', function ($migrator) use ($directory) {
                foreach ((array)$directory as $path) {
                    $migrator->path($path);
                }
            });

        }
    }

}
