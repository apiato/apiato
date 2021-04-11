<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authorization\Tasks\CreateRoleTask;
use App\Ship\Parents\Seeders\Seeder;

class AuthorizationRolesSeeder_2 extends Seeder
{
    public function run(): void
    {
        // Default Roles ----------------------------------------------------------------
        Apiato::call(CreateRoleTask::class, ['admin', 'Administrator', 'Administrator Role', 999]);
    }
}
