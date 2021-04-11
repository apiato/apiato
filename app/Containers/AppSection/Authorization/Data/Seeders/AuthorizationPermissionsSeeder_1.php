<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authorization\Tasks\CreatePermissionTask;
use App\Ship\Parents\Seeders\Seeder;

class AuthorizationPermissionsSeeder_1 extends Seeder
{
    public function run(): void
    {
        // Default Permissions ----------------------------------------------------------
        Apiato::call(CreatePermissionTask::class, ['manage-roles', 'Create, Update, Delete, Get All, Attach/detach permissions to Roles and Get All Permissions.']);
        Apiato::call(CreatePermissionTask::class, ['create-admins', 'Create new Users (Admins) from the dashboard.']);
        Apiato::call(CreatePermissionTask::class, ['manage-admins-access', 'Assign users to Roles.']);
        Apiato::call(CreatePermissionTask::class, ['access-dashboard', 'Access the admins dashboard.']);
    }
}
