<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Containers\AppSection\User\Actions\CreateAdminAction;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;

class SuperAdminSeeder_2 extends ParentSeeder
{
    public function run(CreateAdminAction $action): void
    {
        $userData = [
            'email' => 'admin@admin.com',
            'password' => config('appSection-authorization.admin_role'),
            'name' => 'Super Admin',
        ];

        $action->run($userData);
    }
}
