<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Containers\AppSection\User\Actions\CreateAdminAction;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;

class AuthorizationDefaultUsersSeeder_4 extends ParentSeeder
{
    public function run(CreateAdminAction $action): void
    {
        // Default Users (with their roles) ---------------------------------------------
        $userData = [
            'email'    => 'admin@admin.com',
            'password' => config('appSection-authorization.admin_role'),
            'name'     => 'Super Admin',
        ];

        $action->run($userData);
    }
}
