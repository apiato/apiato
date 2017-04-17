<?php

namespace App\Containers\Authorization\Data\Seeders;

use App\Containers\Authorization\Tasks\CreatePermissionTask;
use App\Ship\Parents\Seeders\Seeder;
use Illuminate\Support\Facades\App;

/**
 * Class AuthorizationPermissionsSeeder_1
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class AuthorizationPermissionsSeeder_1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Permissions ----------------------------------------------------------

        App::make(CreatePermissionTask::class)->run('manage-roles', 'Create, Update, Delete, List, Attach/detach permissions to Roles and List Permissions.');
        App::make(CreatePermissionTask::class)->run('create-admins', 'Create new Users (Admins) from the dashboard.');
        App::make(CreatePermissionTask::class)->run('manage-admins-access', 'Assign users to Roles.');
        App::make(CreatePermissionTask::class)->run('access-dashboard', 'Access the admins dashboard.');

    }
}
