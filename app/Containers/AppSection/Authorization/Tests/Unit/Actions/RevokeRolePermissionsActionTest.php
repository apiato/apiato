<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\RevokeRolePermissionsAction;
use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\RevokeRolePermissionsRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(RevokeRolePermissionsAction::class)]
final class RevokeRolePermissionsActionTest extends UnitTestCase
{
    public function testCanRevokeSinglePermission(): void
    {
        $role = RoleFactory::new()->createOne();
        $permissions = PermissionFactory::new()->count(3)->create();
        $role->givePermissionTo($permissions);
        $request = RevokeRolePermissionsRequest::injectData([
            'role_id' => $role->getHashedKey(),
            'permission_ids' => [$permissions[1]->getHashedKey()],
        ]);
        $action = app(RevokeRolePermissionsAction::class);

        $result = $action->run($request);

        $this->assertCount(2, $result->permissions);
        $this->assertSame($permissions[0]->id, $result->permissions->first()->id);
        $this->assertSame($permissions[2]->id, $result->permissions->last()->id);
    }

    public function testCanRevokeMultiplePermissions(): void
    {
        $role = RoleFactory::new()->createOne();
        $permissions = PermissionFactory::new()->count(3)->create();
        $role->givePermissionTo($permissions);
        $request = RevokeRolePermissionsRequest::injectData([
            'role_id' => $role->getHashedKey(),
            'permission_ids' => [$permissions[0]->getHashedKey(), $permissions[2]->getHashedKey()],
        ]);
        $action = app(RevokeRolePermissionsAction::class);

        $result = $action->run($request);

        $this->assertCount(1, $result->permissions);
        $this->assertSame($permissions[1]->id, $result->permissions->sole()->id);
    }
}
