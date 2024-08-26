<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\GivePermissionsToRoleAction;
use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\GivePermissionsToRoleRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(GivePermissionsToRoleAction::class)]
final class GivePermissionsToRoleActionTest extends UnitTestCase
{
    public function testCanGiveSinglePermission(): void
    {
        $role = RoleFactory::new()->createOne();
        $permission = PermissionFactory::new()->createOne();
        $data = [
            'role_id' => $role->getHashedKey(),
            'permission_ids' => [$permission->getHashedKey()],
        ];
        $request = GivePermissionsToRoleRequest::injectData($data);
        $action = app(GivePermissionsToRoleAction::class);

        $result = $action->run($request);

        $this->assertSame($result->id, $role->id);
        $this->assertTrue($result->hasPermissionTo($permission->name));
    }

    public function testCanGiveMultiplePermissions(): void
    {
        $role = RoleFactory::new()->createOne();
        $permissionA = PermissionFactory::new()->createOne();
        $permissionB = PermissionFactory::new()->createOne();
        $data = [
            'role_id' => $role->getHashedKey(),
            'permission_ids' => [$permissionA->getHashedKey(), $permissionB->getHashedKey()],
        ];
        $request = GivePermissionsToRoleRequest::injectData($data);
        $action = app(GivePermissionsToRoleAction::class);

        $result = $action->run($request);

        $this->assertSame($result->id, $role->id);
        $this->assertTrue($result->hasAllPermissions([$permissionA->name, $permissionB->name]));
    }
}
