<?php

namespace App\Port\Migration\Loaders;

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

    protected $portMigrationsDirectories = [
        'Queue/Data/Migrations',
    ];

    public function runMigrationsAutoLoader()
    {
        $this->loadMigrationsFromContainers();
        $this->loadMigrationsFromPort();
    }

    private function loadMigrationsFromContainers()
    {
        foreach (PortButler::getContainersNames() as $containerName) {

            $containerMigrationDirectory = base_path('app/Containers/' . $containerName . '/Data/Migrations');

            if (File::isDirectory($containerMigrationDirectory)) {

                $this->loadMigrations($containerMigrationDirectory);

            }
        }
    }

    private function loadMigrationsFromPort()
    {
        foreach ($this->portMigrationsDirectories as $portMigrationsDirectory) {
            $this->loadMigrations($portMigrationsDirectory);
        }

    }

    private function loadMigrations($directory)
    {
        App::afterResolving('migrator', function ($migrator) use ($directory) {
            foreach ((array)$directory as $path) {
                $migrator->path($path);
            }
        });
    }

}
