<?php

namespace App\Port\Loader\Loaders;

use App;
use App\Port\Foundation\Portals\Facade\PortButler;
use DB;
use File;

/**
 * Class MigrationsLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait MigrationsLoaderTrait
{

    /**
     * runMigrationsAutoLoader
     */
    public function runMigrationsAutoLoader()
    {
        $this->loadMigrationsFromContainers();
        $this->loadMigrationsFromPort();
    }

    /**
     * loadMigrationsFromContainers
     */
    private function loadMigrationsFromContainers()
    {
        foreach (PortButler::getContainersNames() as $containerName) {

            $containerMigrationDirectory = base_path('app/Containers/' . $containerName . '/Data/Migrations');

            if (File::isDirectory($containerMigrationDirectory)) {

                $this->loadMigrations($containerMigrationDirectory);

            }
        }
    }

    /**
     * loadMigrationsFromPort
     */
    private function loadMigrationsFromPort()
    {
        // `$this->portMigrationsDirectories` is defined in the Main Service Provider
        foreach ($this->portMigrationsDirectories as $portMigrationsDirectory) {
            $this->loadMigrations($portMigrationsDirectory);
        }
    }

    /**
     * @param $directory
     */
    private function loadMigrations($directory)
    {
        App::afterResolving('migrator', function ($migrator) use ($directory) {
            foreach ((array)$directory as $path) {
                $migrator->path($path);
            }
        });
    }

}
