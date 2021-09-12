<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\User\Tasks\CreateUserByCredentialsTask;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Seeders\Seeder;

class AuthorizationDefaultUsersSeeder_3 extends Seeder
{
    /**
     * @throws CreateResourceFailedException
     * @throws NotFoundException
     */
    public function run(): void
    {
        $userData = [
            'email' => 'admin@admin.com',
            'password' => 'admin',
            'name' => 'Super Admin',
        ];

        // Default Users (with their roles) ---------------------------------------------
        $admin = app(CreateUserByCredentialsTask::class)->run($userData, isAdmin: true);
        $admin->assignRole(app(FindRoleTask::class)->run('admin'));
        $admin->email_verified_at = now();
        $admin->save();
    }
}
