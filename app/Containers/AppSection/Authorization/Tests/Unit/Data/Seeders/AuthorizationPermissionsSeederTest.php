<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Seeders;

use App\Containers\AppSection\Authorization\Data\Seeders\AuthorizationPermissionsSeeder_1;
use App\Containers\AppSection\Authorization\Tasks\CreatePermissionTask;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use Mockery\VerificationDirector;
use PHPUnit\Framework\Attributes\CoversClass;

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

        /**
         * @var MockInterface|CreatePermissionTask $mock
         */
        $mock = $this->spy(CreatePermissionTask::class);
        $authorizationPermissionsSeeder1 = new AuthorizationPermissionsSeeder_1();

        $authorizationPermissionsSeeder1->run($mock);

        /**
         * @var VerificationDirector|LegacyMockInterface $legacyMock
         */
        $legacyMock = $mock->shouldHaveReceived('run');

        $legacyMock
            ->withArgs(
                static fn ($name, $description, $displayName, $guardName): bool => \in_array([$name, $description], $data, true)
                    && $displayName === null
                    && \array_key_exists($guardName, config('auth.guards')),
            )
            ->times(\count($data) * \count(config('auth.guards')));
    }
}
