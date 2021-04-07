<?php

namespace App\Containers\Authorization\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Seeders\Seeder;

class AuthorizationDefaultUsersSeeder_3 extends Seeder
{
    public function run(): void
    {
        // Default Users (with their roles) ---------------------------------------------
        $admin = Apiato::call('User@CreateUserByCredentialsTask', [
            true,
            'admin@admin.com',
            'admin',
            'Super Admin',
        ])->assignRole(Apiato::call('Authorization@FindRoleTask', ['admin']));
        $admin->email_verified_at = now();
        $admin->save();
    }
}
