<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Seeders;

use App\Containers\AppSection\Authorization\Data\Seeders\AuthorizationDefaultUsersSeeder_4;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\User\Actions\CreateAdminAction;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(AuthorizationDefaultUsersSeeder_4::class)]
final class AuthorizationDefaultUsersSeederTest extends UnitTestCase
{
    public function testSeedsSuperAdmin(): void
    {
        $actionSpy = $this->spy(CreateAdminAction::class);
        $seeder = new AuthorizationDefaultUsersSeeder_4();

        $seeder->run($actionSpy);

        $actionSpy->shouldHaveReceived('run')->once()->with([
            'email' => 'admin@admin.com',
            'password' => config('appSection-authorization.admin_role'),
            'name' => 'Super Admin',
        ]);
    }
}
