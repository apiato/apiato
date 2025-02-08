<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Seeders;

use App\Containers\AppSection\Authorization\Data\Seeders\AuthorizationSeeder_1;
use App\Containers\AppSection\Authorization\Tasks\CreateRoleTask;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(AuthorizationSeeder_1::class)]
final class AuthorizationSeederTest extends UnitTestCase
{
    public function testCanSeed(): void
    {
        $data = [
            [config('appSection-authorization.admin_role'), 'Administrator', 'Administrator Role'],
        ];

        $taskSpy = $this->spy(CreateRoleTask::class);
        $seeder = new AuthorizationSeeder_1();

        $seeder->run($taskSpy);

        $taskSpy->shouldHaveReceived('run')
            ->withArgs(
                static fn ($name, $description, $displayName, $guardName) => in_array([$name, $description, $displayName], $data)
                    && array_key_exists($guardName, config('auth.guards')),
            )
            ->times(count($data) * count(config('auth.guards')));
    }
}
