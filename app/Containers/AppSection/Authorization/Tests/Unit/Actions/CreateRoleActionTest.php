<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\CreateRoleAction;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(CreateRoleAction::class)]
final class CreateRoleActionTest extends UnitTestCase
{
    public function testCanCreateRole(): void
    {
        $action = app(CreateRoleAction::class);

        $role = $action->run('test-permission', 'test-permission-description', 'test-permission-display-name');

        $this->assertSame('test-permission', $role->name);
        $this->assertSame('test-permission-description', $role->description);
        $this->assertSame('test-permission-display-name', $role->display_name);
        $this->assertSame('api', $role->guard_name);
    }
}
