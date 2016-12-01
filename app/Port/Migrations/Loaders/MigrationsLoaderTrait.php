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

                App::afterResolving('migrator', function ($migrator) use ($containerMigrationDirectory) {
                    foreach ((array)$containerMigrationDirectory as $path) {
                        $migrator->path($path);
                    }
                });
            }
        }
    }

    public function autoLoadPortMigrations()
    {

    }

}
