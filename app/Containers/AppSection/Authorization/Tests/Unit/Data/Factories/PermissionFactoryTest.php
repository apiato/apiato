<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Factories;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;

#[CoversClass(PermissionFactory::class)]
final class PermissionFactoryTest extends UnitTestCase
{
    public function testCanCreatePermission(): void
    {
        $permission = Permission::factory()->createOne();

        $this->assertInstanceOf(Permission::class, $permission);
    }

    #[TestWith(['web'])]
    #[TestWith(['api'])]
    public function testCanSetGuard(string $guard): void
    {
        $permission = Permission::factory()->withGuard($guard)->createOne();
        $this->assertSame($guard, $permission->guard_name);
    }
}
