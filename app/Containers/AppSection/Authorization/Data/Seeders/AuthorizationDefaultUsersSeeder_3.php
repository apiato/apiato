<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\User\Tasks\CreateUserByCredentialsTask;
use App\Ship\Parents\Seeders\Seeder;

class AuthorizationDefaultUsersSeeder_3 extends Seeder
{
    public function run(): void
    {
        // Default Users (with their roles) ---------------------------------------------
        $admin = app(CreateUserByCredentialsTask::class)->run(true, 'admin@admin.com', 'admin', 'Super Admin');
        $admin->assignRole(app(FindRoleTask::class)->run('admin'));
        $admin->email_verified_at = now();
        $admin->save();
    }
}
