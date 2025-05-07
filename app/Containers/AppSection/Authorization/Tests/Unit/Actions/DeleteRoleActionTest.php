<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\DeleteRoleAction;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(DeleteRoleAction::class)]
final class DeleteRoleActionTest extends UnitTestCase
{
    public function testCanDeleteRole(): void
    {
        $role = Role::factory()->createOne();
        $action = app(DeleteRoleAction::class);
        $this->assertModelExists($role);

        $result = $action->run($role->id);

        $this->assertTrue($result);
        $this->assertModelMissing($role);
    }
}
