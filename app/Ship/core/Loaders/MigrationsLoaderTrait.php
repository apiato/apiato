<?php

namespace Apiato\Core\Loaders;

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
        $portMigrationDirectory = base_path('app/Ship/Migrations');

        $this->loadMigrations($portMigrationDirectory);
    }

    /**
     * @param $directory
     */
    private function loadMigrations($directory)
    {
        if (File::isDirectory($directory)) {

            $this->loadMigrationsFrom($directory);

        }
    }

}
