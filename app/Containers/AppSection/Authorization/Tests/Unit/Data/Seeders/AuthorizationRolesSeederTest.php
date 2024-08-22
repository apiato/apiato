<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Seeders;

use App\Containers\AppSection\Authorization\Data\Seeders\AuthorizationRolesSeeder_2;
use App\Containers\AppSection\Authorization\Tasks\CreateRoleTask;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(AuthorizationRolesSeeder_2::class)]
final class AuthorizationRolesSeederTest extends UnitTestCase
{
    public function testCanSeed(): void
    {
        $data = [
            [config('appSection-authorization.admin_role'), 'Administrator', 'Administrator Role'],
        ];

        $taskSpy = $this->spy(CreateRoleTask::class);
        $seeder = new AuthorizationRolesSeeder_2();

        $seeder->run($taskSpy);

        $taskSpy->shouldHaveReceived('run')
            ->withArgs(
                static fn ($name, $description, $displayName, $guardName) => in_array([$name, $description, $displayName], $data)
                    && array_key_exists($guardName, config('auth.guards')),
            )
            ->times(count($data) * count(config('auth.guards')));
    }
}
