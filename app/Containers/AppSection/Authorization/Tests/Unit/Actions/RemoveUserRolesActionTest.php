<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\RemoveUserRolesAction;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RemoveUserRolesAction::class)]
final class RemoveUserRolesActionTest extends UnitTestCase
{
    public function testCanRemoveRole(): void
    {
        $user = User::factory()->createOne();
        $roles = Role::factory()->count(3)->create();
        $user->assignRole($roles);
        $action = app(RemoveUserRolesAction::class);

        $result = $action->run($user->id, $roles[1]->id);

        self::assertCount(2, $result->roles);
        self::assertSame($roles[0]->id, $result->roles->first()->id);
        self::assertSame($roles[2]->id, $result->roles->last()->id);
    }

    public function testCanRemoveRoles(): void
    {
        $user = User::factory()->createOne();
        $roles = Role::factory()->count(3)->create();
        $user->assignRole($roles);
        $action = app(RemoveUserRolesAction::class);

        $result = $action->run($user->id, $roles[0]->id, $roles[2]->id);

        self::assertCount(1, $result->roles);
        self::assertSame($roles[1]->id, $result->roles->sole()->id);
    }
}
