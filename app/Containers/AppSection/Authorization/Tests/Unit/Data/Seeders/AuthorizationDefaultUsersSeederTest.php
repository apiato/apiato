<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Seeders;

use App\Containers\AppSection\Authorization\Data\Seeders\AuthorizationDefaultUsersSeeder_4;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\User\Actions\CreateAdminAction;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use Mockery\VerificationDirector;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(AuthorizationDefaultUsersSeeder_4::class)]
final class AuthorizationDefaultUsersSeederTest extends UnitTestCase
{
    public function testSeedsSuperAdmin(): void
    {
        /**
         * @var MockInterface|CreateAdminAction $mock
         */
        $mock = $this->spy(CreateAdminAction::class);
        $authorizationDefaultUsersSeeder4 = new AuthorizationDefaultUsersSeeder_4();

        $authorizationDefaultUsersSeeder4->run($mock);

        /**
         * @var VerificationDirector|LegacyMockInterface $legacyMock
         */
        $legacyMock = $mock->shouldHaveReceived('run');

        $legacyMock
            ->once()
            ->with([
                'email'    => 'admin@admin.com',
                'password' => config('appSection-authorization.admin_role'),
                'name'     => 'Super Admin',
            ]);
    }
}
