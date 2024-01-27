<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Seeders;

use App\Containers\AppSection\Authorization\Data\Seeders\AuthorizationDefaultUsersSeeder_4;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(AuthorizationDefaultUsersSeeder_4::class)]
final class AuthorizationDefaultUsersSeederTest extends UnitTestCase
{
    public function testSeedsSuperAdmin(): void
    {
        $admin = User::where('email', '=', 'admin@admin.com')->first();

        $this->assertNotNull($admin);
        $this->assertTrue($admin->hasRole(config('appSection-authorization.admin_role')));
        $this->assertSame($admin->name, 'Super Admin');
    }
}
