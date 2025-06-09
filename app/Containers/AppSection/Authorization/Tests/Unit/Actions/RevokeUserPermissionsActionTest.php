<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\RevokeUserPermissionsAction;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RevokeUserPermissionsAction::class)]
final class RevokeUserPermissionsActionTest extends UnitTestCase
{
    public function testCanRevokeSinglePermission(): void
    {
        $user = User::factory()->createOne();
        $permissions = Permission::factory()->count(3)->create();
        $user->givePermissionTo($permissions);
        $action = app(RevokeUserPermissionsAction::class);

        $result = $action->run($user->id, $permissions[1]->id);

        self::assertCount(2, $result->permissions);
        self::assertSame($permissions[0]->id, $result->permissions->first()->id);
        self::assertSame($permissions[2]->id, $result->permissions->last()->id);
    }

    public function testCanRevokeMultiplePermissions(): void
    {
        $user = User::factory()->createOne();
        $permissions = Permission::factory()->count(3)->create();
        $user->givePermissionTo($permissions);
        $action = app(RevokeUserPermissionsAction::class);

        $result = $action->run($user->id, $permissions[0]->id, $permissions[2]->id);

        self::assertCount(1, $result->permissions);
        self::assertSame($permissions[1]->id, $result->permissions->sole()->id);
    }
}
