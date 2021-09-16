<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Containers\AppSection\Authorization\Tasks\CreateRoleTask;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Seeders\Seeder;

class AuthorizationRolesSeeder_2 extends Seeder
{
    /**
     * @throws CreateResourceFailedException
     */
    public function run(): void
    {
        // Default Roles ----------------------------------------------------------------
        app(CreateRoleTask::class)->run('admin', 'Administrator', 'Administrator Role');
    }
}
