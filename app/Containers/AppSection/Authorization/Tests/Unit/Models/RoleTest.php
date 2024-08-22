<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Models;

use Apiato\Core\Traits\ModelTrait;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(Role::class)]
final class RoleTest extends UnitTestCase
{
    public function testUsesCorrectTraits(): void
    {
        $this->assertContains(ModelTrait::class, class_uses_recursive(Role::class));
    }

    public function testUsesCorrectGuard(): void
    {
        $user = RoleFactory::new()->createOne();
        $guard = 'api';

        $this->assertSame($guard, $this->getInaccessiblePropertyValue($user, 'guard_name'));
    }

    public function testHasCorrectFillableFields(): void
    {
        $role = RoleFactory::new()->createOne();
        $fillables = [
            'name',
            'guard_name',
            'display_name',
            'description',
        ];

        foreach ($fillables as $fillable) {
            $this->assertContains($fillable, $role->getFillable());
        }
    }

    public function testUsesCorrectTable(): void
    {
        $role = RoleFactory::new()->createOne();
        $table = 'roles';

        $this->assertSame($table, $role->getTable());
    }

    public function testHasCorrectResourceKey(): void
    {
        $user = RoleFactory::new()->createOne();

        $this->assertSame('Role', $user->getResourceKey());
    }
}
