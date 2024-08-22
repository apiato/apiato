<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Models;

use Apiato\Core\Traits\ModelTrait;
use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(Permission::class)]
final class PermissionTest extends UnitTestCase
{
    public function testUsesCorrectTraits(): void
    {
        $this->assertContains(ModelTrait::class, class_uses_recursive(Permission::class));
    }

    public function testUsesCorrectGuard(): void
    {
        $permission = PermissionFactory::new()->createOne();
        $guard = 'api';

        $this->assertSame($guard, $this->getInaccessiblePropertyValue($permission, 'guard_name'));
    }

    public function testHasCorrectFillableFields(): void
    {
        $permission = PermissionFactory::new()->createOne();
        $fillables = [
            'name',
            'guard_name',
            'display_name',
            'description',
        ];

        foreach ($fillables as $fillable) {
            $this->assertContains($fillable, $permission->getFillable());
        }
    }

    public function testUsesCorrectTable(): void
    {
        $permission = PermissionFactory::new()->createOne();
        $table = 'permissions';

        $this->assertSame($table, $permission->getTable());
    }

    public function testHasCorrectResourceKey(): void
    {
        $permission = PermissionFactory::new()->createOne();

        $this->assertSame('Permission', $permission->getResourceKey());
    }
}
