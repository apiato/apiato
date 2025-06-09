<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\GivePermissionsToRoleAction;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(GivePermissionsToRoleAction::class)]
final class GivePermissionsToRoleActionTest extends UnitTestCase
{
    public function testCanGiveSinglePermission(): void
    {
        $role = Role::factory()->createOne();
        $permission = Permission::factory()->createOne();
        $action = app(GivePermissionsToRoleAction::class);

        $result = $action->run($role->id, $permission->id);

        self::assertSame($result->id, $role->id);
        self::assertTrue($result->hasPermissionTo($permission->name));
    }

    public function testCanGiveMultiplePermissions(): void
    {
        $role = Role::factory()->createOne();
        $permissionA = Permission::factory()->createOne();
        $permissionB = Permission::factory()->createOne();
        $action = app(GivePermissionsToRoleAction::class);

        $result = $action->run($role->id, $permissionA->id, $permissionB->id);

        self::assertSame($result->id, $role->id);
        self::assertTrue($result->hasAllPermissions([$permissionA->name, $permissionB->name]));
    }
}
