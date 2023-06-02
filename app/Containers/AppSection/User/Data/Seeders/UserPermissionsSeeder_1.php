<?php

namespace App\Containers\AppSection\User\Data\Seeders;

use App\Containers\AppSection\Authorization\Tasks\CreatePermissionTask;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;

class UserPermissionsSeeder_1 extends ParentSeeder
{
    public function __construct(
        private readonly CreatePermissionTask $createPermissionTask
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(): void
    {
        // Default Permissions for every Guard ----------------------------------------------------------
        foreach (array_keys(config('auth.guards')) as $guardName) {
            $this->createPermissionTask->run('search-users', 'Find a User in the DB.', guardName: $guardName);
            $this->createPermissionTask->run('list-users', 'Get All Users.', guardName: $guardName);
            $this->createPermissionTask->run('update-users', 'Update a User.', guardName: $guardName);
            $this->createPermissionTask->run('delete-users', 'Delete a User.', guardName: $guardName);
            $this->createPermissionTask->run('refresh-users', 'Refresh User data.', guardName: $guardName);
        }
    }
}
