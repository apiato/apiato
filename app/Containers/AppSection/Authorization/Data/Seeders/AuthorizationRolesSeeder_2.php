<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Containers\AppSection\Authorization\Tasks\CreateRoleTask;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;

class AuthorizationRolesSeeder_2 extends ParentSeeder
{
    public function __construct(
        private readonly CreateRoleTask $createRoleTask
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(): void
    {
        // Default Roles for every Guard ----------------------------------------------------------------
        foreach (array_keys(config('auth.guards')) as $guardName) {
            $this->createRoleTask->run(config('appSection-authorization.admin_role'), 'Administrator', 'Administrator Role', $guardName);
        }
    }
}
