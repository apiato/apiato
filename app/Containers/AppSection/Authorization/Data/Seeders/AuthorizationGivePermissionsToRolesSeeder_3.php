<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Ship\Parents\Seeders\Seeder;
use Artisan;

class AuthorizationGivePermissionsToRolesSeeder_3 extends Seeder
{
    public function run(): void
    {
        // Give all permissions to 'admin role ----------------------------------------------------------------
        Artisan::call('apiato:permissions:toRole admin');

        // Give permissions to roles ----------------------------------------------------------------
        //
    }
}
