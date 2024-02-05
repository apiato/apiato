<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Seeders;

use App\Containers\AppSection\Authorization\Data\Seeders\AuthorizationGivePermissionsToRolesSeeder_3;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(AuthorizationGivePermissionsToRolesSeeder_3::class)]
final class AuthorizationGivePermissionsToRolesSeederTest extends UnitTestCase
{
    public function testGivesAllPermissionsToAdmin(): void
    {
        $adminRoleName = config('appSection-authorization.admin_role');
        $adminRoles = Role::whereName($adminRoleName)->get();

        $this->assertNotEmpty($adminRoles);
        foreach ($adminRoles as $adminRole) {
            $this->assertTrue($adminRole->hasAllPermissions());
        }
    }
}
