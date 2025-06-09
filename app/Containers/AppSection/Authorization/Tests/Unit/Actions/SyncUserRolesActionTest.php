<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\SyncUserRolesAction;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(SyncUserRolesAction::class)]
final class SyncUserRolesActionTest extends UnitTestCase
{
    public function testCanSyncPermission(): void
    {
        $user = User::factory()->createOne();
        $roles = Role::factory()->count(3)->create();
        $user->assignRole($roles);
        self::assertCount(3, $user->roles);
        $action = app(SyncUserRolesAction::class);

        $result = $action->run($user->id, $roles[1]->id);

        self::assertCount(1, $result->roles);
        self::assertSame($roles[1]->id, $result->roles->sole()->id);
    }

    public function testCanSyncPermissions(): void
    {
        $user = User::factory()->createOne();
        $roles = Role::factory()->count(3)->create();
        $user->assignRole($roles);
        self::assertCount(3, $user->roles);
        $action = app(SyncUserRolesAction::class);

        $result = $action->run($user->id, $roles[0]->id, $roles[2]->id);

        self::assertCount(2, $result->roles);
        self::assertSame($roles[0]->id, $result->roles->first()->id);
        self::assertSame($roles[2]->id, $result->roles->last()->id);
    }
}
