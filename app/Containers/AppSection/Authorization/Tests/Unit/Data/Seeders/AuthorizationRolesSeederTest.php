<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Seeders;

use App\Containers\AppSection\Authorization\Data\Seeders\AuthorizationRolesSeeder_2;
use App\Containers\AppSection\Authorization\Tasks\CreateRoleTask;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Ship\Exceptions\CreateResourceFailedException;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use Mockery\VerificationDirector;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(AuthorizationRolesSeeder_2::class)]
final class AuthorizationRolesSeederTest extends UnitTestCase
{
    /**
     * @throws CreateResourceFailedException
     */
    public function testCanSeed(): void
    {
        $data = [
            [config('appSection-authorization.admin_role'), 'Administrator', 'Administrator Role'],
        ];

        /**
         * @var MockInterface|CreateRoleTask $mock
         */
        $mock = $this->spy(CreateRoleTask::class);
        $authorizationRolesSeeder2 = new AuthorizationRolesSeeder_2();

        $authorizationRolesSeeder2->run($mock);

        /**
         * @var VerificationDirector|LegacyMockInterface $legacyMock
         */
        $legacyMock = $mock->shouldHaveReceived('run');

        $legacyMock
            ->withArgs(
                static fn ($name, $description, $displayName, $guardName): bool => \in_array([$name, $description, $displayName], $data, true)
                    && \array_key_exists($guardName, config('auth.guards')),
            )
            ->times(\count(config('auth.guards')));
    }
}
