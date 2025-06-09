<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\GivePermissionsToUserAction;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(GivePermissionsToUserAction::class)]
final class GivePermissionsToUserActionTest extends UnitTestCase
{
    public function testCanGiveSinglePermission(): void
    {
        $user = User::factory()->createOne();
        $permission = Permission::factory()->createOne();
        $action = app(GivePermissionsToUserAction::class);

        $result = $action->run($user->id, $permission->id);

        self::assertSame($result->id, $user->id);
        self::assertTrue($result->hasPermissionTo($permission->name));
    }

    public function testCanGiveMultiplePermissions(): void
    {
        $user = User::factory()->createOne();
        $permissionA = Permission::factory()->createOne();
        $permissionB = Permission::factory()->createOne();
        $action = app(GivePermissionsToUserAction::class);

        $result = $action->run($user->id, $permissionA->id, $permissionB->id);

        self::assertSame($result->id, $user->id);
        self::assertTrue($result->hasAllPermissions([$permissionA->name, $permissionB->name]));
    }
}
