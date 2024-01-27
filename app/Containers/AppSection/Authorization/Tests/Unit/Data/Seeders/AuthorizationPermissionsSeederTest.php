<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Seeders;

use App\Containers\AppSection\Authorization\Data\Seeders\AuthorizationPermissionsSeeder_1;
use App\Containers\AppSection\Authorization\Tasks\CreatePermissionTask;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(AuthorizationPermissionsSeeder_1::class)]
final class AuthorizationPermissionsSeederTest extends UnitTestCase
{
    public function testCanSeed(): void
    {
        $data = [
            ['manage-roles', 'Create, Update, Delete, Get All, Attach/detach permissions to Roles and Get All Permissions.'],
            ['manage-permissions', 'Create, Update, Delete, Get All, Attach/detach permissions to User.'],
            ['create-admins', 'Create new Users (Admins) from the dashboard.'],
            ['manage-admins-access', 'Assign users to Roles.'],
            ['access-dashboard', 'Access the admins dashboard.'],
        ];
        $taskSpy = $this->spy(CreatePermissionTask::class);
        $seeder = new AuthorizationPermissionsSeeder_1();

        $seeder->run($taskSpy);

        $taskSpy->shouldHaveReceived('run')
            ->withArgs(
                static fn ($name, $description, $displayName, $guardName) => in_array([$name, $description], $data)
                    && null === $displayName
                    && array_key_exists($guardName, config('auth.guards')),
            )
            ->times(count($data) * count(config('auth.guards')));
    }
}
