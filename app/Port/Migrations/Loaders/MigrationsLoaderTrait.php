<?php

namespace App\Port\Migrations\Loaders;

use App;
use App\Port\Butler\Portals\Facade\PortButler;
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

    public function autoLoadMigrations()
    {
        $this->autoLoadContainersMigrations();
        $this->autoLoadPortMigrations();
    }

    public function autoLoadContainersMigrations()
    {
        foreach (PortButler::getContainersNames() as $containerName) {

            $containerMigrationDirectory = base_path('app/Containers/' . $containerName . '/Data/Migrations');

            if (File::isDirectory($containerMigrationDirectory)) {

                $this->migrate($containerMigrationDirectory);

            }
        }
    }

    public function autoLoadPortMigrations()
    {
        foreach ($this->portMigrationsDirectories as $portMigrationsDirectory) {
            $this->migrate($portMigrationsDirectory);
        }

    }

    private function migrate($directory)
    {
        App::afterResolving('migrator', function ($migrator) use ($directory) {
            foreach ((array)$directory as $path) {
                $migrator->path($path);
            }
        });
    }

}
