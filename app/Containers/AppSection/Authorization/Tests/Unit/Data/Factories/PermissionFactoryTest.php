<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Factories;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Ship\Enums\AuthGuard;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(PermissionFactory::class)]
final class PermissionFactoryTest extends UnitTestCase
{
    public function testCanCreatePermission(): void
    {
        $model = PermissionFactory::new()->createOne();

        $this->assertInstanceOf(Permission::class, $model);
    }

    public function testCanSetGuard(): void
    {
        $model = PermissionFactory::new()->withGuard(AuthGuard::API->value)->createOne();

        $this->assertSame(AuthGuard::API->value, $model->guard_name);
    }
}
