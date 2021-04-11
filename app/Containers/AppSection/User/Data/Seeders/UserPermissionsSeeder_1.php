<?php

namespace App\Containers\AppSection\User\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authorization\Tasks\CreatePermissionTask;
use App\Ship\Parents\Seeders\Seeder;

class UserPermissionsSeeder_1 extends Seeder
{
    public function run(): void
    {
        // Default Permissions ----------------------------------------------------------
        Apiato::call(CreatePermissionTask::class, ['search-users', 'Find a User in the DB.']);
        Apiato::call(CreatePermissionTask::class, ['list-users', 'Get All Users.']);
        Apiato::call(CreatePermissionTask::class, ['update-users', 'Update a User.']);
        Apiato::call(CreatePermissionTask::class, ['delete-users', 'Delete a User.']);
        Apiato::call(CreatePermissionTask::class, ['refresh-users', 'Refresh User data.']);
    }
}
