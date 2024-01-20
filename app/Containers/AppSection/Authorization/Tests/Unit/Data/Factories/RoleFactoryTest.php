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
    public function testCreateRole(): void
    {
        $role = RoleFactory::new()->createOne();

        $this->assertInstanceOf(Role::class, $role);
    }

    public function testCreateAdminRole(): void
    {
        // 'admin' role is seeded into db automatically, so we have to remove it first before we can test creating it
        // using factory
        Role::findByName(config('appSection-authorization.admin_role'))->delete();

        $role = RoleFactory::new()->admin()->createOne();

        $this->assertSame(config('appSection-authorization.admin_role'), $role->name);
    }
}
