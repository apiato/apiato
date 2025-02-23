<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\AssignRolesToUserAction;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(AssignRolesToUserAction::class)]
final class AssignRolesToUserActionTest extends UnitTestCase
{
    public function testCanAssignSingleRole(): void
    {
        $user = User::factory()->createOne();
        $role = Role::factory()->createOne();
        $action = app(AssignRolesToUserAction::class);

        $result = $action->run($user->id, $role->id);

        $this->assertSame($result->id, $user->id);
        $this->assertTrue($result->hasRole($role->name));
    }

    public function testCanAssignMultipleRole(): void
    {
        $user = User::factory()->createOne();
        $roleA = Role::factory()->createOne();
        $roleB = Role::factory()->createOne();
        $action = app(AssignRolesToUserAction::class);

        $result = $action->run($user->id, $roleA->id, $roleB->id);

        $this->assertSame($result->id, $user->id);
        $this->assertTrue($result->hasAllRoles([$roleA->name, $roleB->name]));
    }
}
