<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\ListUserRolesAction;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ListUserRolesAction::class)]
final class ListUserRolesActionTest extends UnitTestCase
{
    public function testCanListRoles(): void
    {
        $user = User::factory()->createOne()
            ->assignRole(Role::factory()->count(3)->create());
        $action = app(ListUserRolesAction::class);

        $result = $action->run($user->id);

        $this->assertCount(3, $result);
    }
}
