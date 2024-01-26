<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Factories;

use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(RoleFactory::class)]
final class RoleFactoryTest extends UnitTestCase
{
    public function testCanCreateRole(): void
    {
        $role = RoleFactory::new()->createOne();

        $this->assertInstanceOf(Role::class, $role);
    }

    public function testCanCreateAdminRole(): void
    {
        // Since 'admin' is seeded in the database, we need to delete it first
        // to avoid "duplicate key" error.
        $roleName = config('appSection-authorization.admin_role');
        $adminRole = Role::findByName($roleName);
        $adminRole->delete();
        $this->assertModelMissing($adminRole);

        $role = RoleFactory::new()->admin()->createOne();

        $this->assertSame($roleName, $role->name);
    }
}
