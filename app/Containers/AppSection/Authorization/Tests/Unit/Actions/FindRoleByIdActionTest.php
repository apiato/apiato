<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\FindRoleByIdAction;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(FindRoleByIdAction::class)]
final class FindRoleByIdActionTest extends UnitTestCase
{
    public function testCanFindRole(): void
    {
        $role = Role::factory()->createOne();

        $result = app(FindRoleByIdAction::class)->run($role->id);

        $this->assertTrue($role->is($result));
    }
}
