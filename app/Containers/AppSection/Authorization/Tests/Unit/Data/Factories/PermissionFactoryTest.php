<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Factories;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(PermissionFactory::class)]
final class PermissionFactoryTest extends UnitTestCase
{
    public function testCreatePermission(): void
    {
        $permission = PermissionFactory::new()->createOne();

        $this->assertInstanceOf(Permission::class, $permission);
    }
}
