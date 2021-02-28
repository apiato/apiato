<?php

namespace Apiato\Core\Loaders;

use Illuminate\Support\Facades\File;

trait MigrationsLoaderTrait
{
    public function loadMigrationsFromContainers($containerName): void
    {
        $containerMigrationDirectory = base_path('app/Containers/' . $containerName . '/Data/Migrations');

        $this->loadMigrations($containerMigrationDirectory);
    }

    private function loadMigrations($directory): void
    {
        if (File::isDirectory($directory)) {

            $this->loadMigrationsFrom($directory);

        }
    }

    public function loadMigrationsFromShip(): void
    {
        $portMigrationDirectory = base_path('app/Ship/Migrations');

        $this->loadMigrations($portMigrationDirectory);
    }
}
