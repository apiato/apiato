<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;

/**
 * @group authorization
 * @group unit
 */
class PermissionFactoryTest extends UnitTestCase
{
    public function testCreatePermission(): void
    {
        $permission = PermissionFactory::new()->createOne();

        $this->assertInstanceOf(Permission::class, $permission);
    }
}
