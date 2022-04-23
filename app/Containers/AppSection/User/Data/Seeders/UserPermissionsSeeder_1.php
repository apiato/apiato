<?php

namespace App\Containers\AppSection\User\Data\Seeders;

use App\Containers\AppSection\Authorization\Tasks\CreatePermissionTask;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;

class UserPermissionsSeeder_1 extends ParentSeeder
{
    /**
     * @throws CreateResourceFailedException
     */
    public function run(): void
    {
        // Default Permissions for every Guard ----------------------------------------------------------
        $createPermissionTask = app(CreatePermissionTask::class);
        foreach (array_keys(config('auth.guards')) as $guardName) {
            $createPermissionTask->run('search-users', 'Find a User in the DB.', guardName: $guardName);
            $createPermissionTask->run('list-users', 'Get All Users.', guardName: $guardName);
            $createPermissionTask->run('update-users', 'Update a User.', guardName: $guardName);
            $createPermissionTask->run('delete-users', 'Delete a User.', guardName: $guardName);
            $createPermissionTask->run('refresh-users', 'Refresh User data.', guardName: $guardName);
        }
    }
}
