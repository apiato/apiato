<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\GivePermissionsToRoleAction;
use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\GivePermissionsToRoleRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(GivePermissionsToRoleAction::class)]
final class GivePermissionsToRoleActionTest extends UnitTestCase
{
    public function testCanGiveSinglePermission(): void
    {
        $model = RoleFactory::new()->createOne();
        $permission = PermissionFactory::new()->createOne();
        $data = [
            'permission_ids' => [$permission->getHashedKey()],
        ];
        $givePermissionsToRoleRequest = GivePermissionsToRoleRequest::injectData($data)
            ->withUrlParameters(['role_id' => $model->id]);
        $action = app(GivePermissionsToRoleAction::class);

        $result = $action->run($givePermissionsToRoleRequest);

        $this->assertSame($result->id, $model->id);
        $this->assertTrue($result->hasPermissionTo($permission->name));
    }

    public function testCanGiveMultiplePermissions(): void
    {
        $model = RoleFactory::new()->createOne();
        $permissionA = PermissionFactory::new()->createOne();
        $permissionB = PermissionFactory::new()->createOne();
        $data = [
            'permission_ids' => [$permissionA->getHashedKey(), $permissionB->getHashedKey()],
        ];
        $givePermissionsToRoleRequest = GivePermissionsToRoleRequest::injectData($data)
            ->withUrlParameters(['role_id' => $model->id]);
        $action = app(GivePermissionsToRoleAction::class);

        $result = $action->run($givePermissionsToRoleRequest);

        $this->assertSame($result->id, $model->id);
        $this->assertTrue($result->hasAllPermissions([$permissionA->name, $permissionB->name]));
    }
}
