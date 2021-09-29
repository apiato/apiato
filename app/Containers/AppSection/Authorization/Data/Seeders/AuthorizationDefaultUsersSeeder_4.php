<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Containers\AppSection\User\Actions\CreateAdminAction;
use App\Containers\AppSection\User\UI\API\Requests\CreateAdminRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Seeders\Seeder;

class AuthorizationDefaultUsersSeeder_4 extends Seeder
{
    /**
     * @throws CreateResourceFailedException
     */
    public function run(): void
    {
        $userData = [
            'email' => 'admin@admin.com',
            'password' => 'admin',
            'name' => 'Super Admin',
        ];

        // Default Users (with their roles) ---------------------------------------------
        $request = new CreateAdminRequest($userData);
        $admin = app(CreateAdminAction::class)->run($request);
        $admin->email_verified_at = now();
        $admin->save();
    }
}
