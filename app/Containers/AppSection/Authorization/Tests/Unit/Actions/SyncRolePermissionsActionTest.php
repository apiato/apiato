<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\SyncRolePermissionsAction;
use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncRolePermissionsRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(SyncRolePermissionsAction::class)]
final class SyncRolePermissionsActionTest extends UnitTestCase
{
    public function testCanSyncPermission(): void
    {
        $role = RoleFactory::new()->createOne();
        $permissions = PermissionFactory::new()->count(3)->create();
        $role->givePermissionTo($permissions);
        $this->assertCount(3, $role->permissions);
        $request = SyncRolePermissionsRequest::injectData([
            'role_id' => $role->getHashedKey(),
            'permission_ids' => $permissions[1]->getHashedKey(),
        ]);
        $action = app(SyncRolePermissionsAction::class);

        $result = $action->run($request);

        $this->assertCount(1, $result->permissions);
        $this->assertSame($permissions[1]->id, $result->permissions->sole()->id);
    }

    public function testCanSyncPermissions(): void
    {
        $role = RoleFactory::new()->createOne();
        $permissions = PermissionFactory::new()->count(3)->create();
        $role->givePermissionTo($permissions);
        $this->assertCount(3, $role->permissions);
        $request = SyncRolePermissionsRequest::injectData([
            'role_id' => $role->getHashedKey(),
            'permission_ids' => [$permissions[0]->getHashedKey(), $permissions[2]->getHashedKey()],
        ]);
        $action = app(SyncRolePermissionsAction::class);

        $result = $action->run($request);

        $this->assertCount(2, $result->permissions);
        $this->assertSame($permissions[0]->id, $result->permissions->first()->id);
        $this->assertSame($permissions[2]->id, $result->permissions->last()->id);
    }
}
