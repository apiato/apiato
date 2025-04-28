<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\RevokeRolePermissionsAction;
use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\RevokeRolePermissionsRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RevokeRolePermissionsAction::class)]
final class RevokeRolePermissionsActionTest extends UnitTestCase
{
    public function testCanRevokeSinglePermission(): void
    {
        $model = RoleFactory::new()->createOne();
        $permissions = PermissionFactory::new()->count(3)->create();
        $model->givePermissionTo($permissions);
        $revokeRolePermissionsRequest = RevokeRolePermissionsRequest::injectData([
            'permission_ids' => [$permissions[1]->getHashedKey()],
        ])->withUrlParameters(['role_id' => $model->id]);
        $action = app(RevokeRolePermissionsAction::class);

        $result = $action->run($revokeRolePermissionsRequest);

        $this->assertCount(2, $result->permissions);
        $this->assertSame($permissions[0]->id, $result->permissions->first()->id);
        $this->assertSame($permissions[2]->id, $result->permissions->last()->id);
    }

    public function testCanRevokeMultiplePermissions(): void
    {
        $model = RoleFactory::new()->createOne();
        $permissions = PermissionFactory::new()->count(3)->create();
        $model->givePermissionTo($permissions);
        $revokeRolePermissionsRequest = RevokeRolePermissionsRequest::injectData([
            'permission_ids' => [$permissions[0]->getHashedKey(), $permissions[2]->getHashedKey()],
        ])->withUrlParameters(['role_id' => $model->id]);
        $action = app(RevokeRolePermissionsAction::class);

        $result = $action->run($revokeRolePermissionsRequest);

        $this->assertCount(1, $result->permissions);
        $this->assertSame($permissions[1]->id, $result->permissions->sole()->id);
    }
}
