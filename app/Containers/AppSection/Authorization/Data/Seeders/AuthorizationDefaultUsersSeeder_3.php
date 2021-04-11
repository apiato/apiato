<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\User\Tasks\CreateUserByCredentialsTask;
use App\Ship\Parents\Seeders\Seeder;

class AuthorizationDefaultUsersSeeder_3 extends Seeder
{
    public function run(): void
    {
        // Default Users (with their roles) ---------------------------------------------
        $admin = Apiato::call(CreateUserByCredentialsTask::class, [
            true,
            'admin@admin.com',
            'admin',
            'Super Admin',
        ])->assignRole(Apiato::call(FindRoleTask::class, ['admin']));
        $admin->email_verified_at = now();
        $admin->save();
    }
}
