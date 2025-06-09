<?php

declare(strict_types=1);

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

        self::assertSame('test-permission', $role->name);
        self::assertSame('test-permission-description', $role->description);
        self::assertSame('test-permission-display-name', $role->display_name);
        self::assertSame('api', $role->guard_name);
    }
}
