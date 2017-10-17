<?php

namespace App\Containers\User\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Seeders\Seeder;

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
        Apiato::call('Authorization@CreatePermissionTask', ['search-users', 'Find a User in the DB.']);
        Apiato::call('Authorization@CreatePermissionTask', ['list-users', 'Get All Users.']);
        Apiato::call('Authorization@CreatePermissionTask', ['update-users', 'Update a User.']);
        Apiato::call('Authorization@CreatePermissionTask', ['delete-users', 'Delete a User.']);
        Apiato::call('Authorization@CreatePermissionTask', ['refresh-users', 'Refresh User data.']);

        // ...

    }
}
