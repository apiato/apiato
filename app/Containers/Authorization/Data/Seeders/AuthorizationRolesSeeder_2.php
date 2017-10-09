<?php

namespace App\Containers\Authorization\Data\Seeders;

use App\Containers\Authorization\Tasks\CreateRoleTask;
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
        // Default Roles ----------------------------------------------------------------

        App::make(CreateRoleTask::class)->run('admin', 'Administrator');

        // ...

    }
}
