<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\SyncRolePermissionsAction;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(SyncRolePermissionsAction::class)]
final class SyncRolePermissionsActionTest extends UnitTestCase
{
    public function testCanSyncPermission(): void
    {
        $role = Role::factory()->createOne();
        $permissions = Permission::factory()->count(3)->create();
        $role->givePermissionTo($permissions);
        self::assertCount(3, $role->permissions);
        $action = app(SyncRolePermissionsAction::class);

        $result = $action->run($role->id, $permissions[1]->id);

        self::assertCount(1, $result->permissions);
        self::assertSame($permissions[1]->id, $result->permissions->sole()->id);
    }

    public function testCanSyncPermissions(): void
    {
        $role = Role::factory()->createOne();
        $permissions = Permission::factory()->count(3)->create();
        $role->givePermissionTo($permissions);
        self::assertCount(3, $role->permissions);
        $action = app(SyncRolePermissionsAction::class);

        $result = $action->run($role->id, $permissions[0]->id, $permissions[2]->id);

        self::assertCount(2, $result->permissions);
        self::assertSame($permissions[0]->id, $result->permissions->first()->id);
        self::assertSame($permissions[2]->id, $result->permissions->last()->id);
    }
}
