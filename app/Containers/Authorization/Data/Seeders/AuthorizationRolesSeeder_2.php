<?php

namespace App\Containers\Authorization\Data\Seeders;

use App\Containers\Authorization\Tasks\CreateRoleTask;
use App\Containers\Authorization\Tasks\ListAllPermissionsTask;
use App\Ship\Parents\Seeders\Seeder;
use Illuminate\Support\Facades\App;

/**
 * Class AuthorizationRolesSeeder_2
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class AuthorizationRolesSeeder_2 extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Role ----------------------------------------------------------------

        // give the super admin all the available permissions, while seeding
        App::make(CreateRoleTask::class)->run('admin', 'Administrator')->givePermissionTo(
            App::make(ListAllPermissionsTask::class)->run()->pluck('name')->toArray()
        );

    }
}
