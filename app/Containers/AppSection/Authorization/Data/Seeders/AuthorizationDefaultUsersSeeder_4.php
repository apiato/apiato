<?php

namespace App\Containers\AppSection\Authorization\Data\Seeders;

use App\Containers\AppSection\User\Actions\CreateAdminAction;
use App\Containers\AppSection\User\Data\Resources\RegisterUserDto;
use App\Containers\AppSection\User\Data\Resources\UserResource;
use App\Containers\AppSection\User\Values\Email;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;

class AuthorizationDefaultUsersSeeder_4 extends ParentSeeder
{
    /**
     * @throws CreateResourceFailedException
     * @throws \Throwable
     */
    public function run(CreateAdminAction $action): void
    {
        // Default Users (with their roles) ---------------------------------------------
        $data = new RegisterUserDto(
            'Super Admin',
            null,
            new Email('admin@admin.com'),
            config('appSection-authorization.admin_role'),
        );

        $action->run($data);
    }
}
