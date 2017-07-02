<?php

namespace App\Containers\User\Data\Seeders;

use App\Containers\Authorization\Tasks\CreatePermissionTask;
use App\Ship\Parents\Seeders\Seeder;
use Illuminate\Support\Facades\App;

/**
 * Class UserPermissionsSeeder_1
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UserPermissionsSeeder_1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Permissions ----------------------------------------------------------

        App::make(CreatePermissionTask::class)->run('search-users', 'Find a User in the DB.');
        App::make(CreatePermissionTask::class)->run('list-users', 'List all Users.');
        App::make(CreatePermissionTask::class)->run('update-users', 'Update a User.');
        App::make(CreatePermissionTask::class)->run('delete-users', 'Delete a User.');
        App::make(CreatePermissionTask::class)->run('refresh-users', 'Refresh User data.');

        // ...

    }
}
