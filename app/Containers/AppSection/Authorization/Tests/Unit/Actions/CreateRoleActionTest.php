<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\CreateRoleAction;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\CreateRoleRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(CreateRoleAction::class)]
final class CreateRoleActionTest extends UnitTestCase
{
    public function testCanCreateRole(): void
    {
        $request = CreateRoleRequest::injectData([
            'name' => 'test-permission',
            'description' => 'test-permission-description',
            'display_name' => 'test-permission-display-name',
        ]);
        $action = app(CreateRoleAction::class);

        $role = $action->run($request);

        $this->assertSame($request->name, $role->name);
        $this->assertSame($request->description, $role->description);
        $this->assertSame($request->display_name, $role->display_name);
        $this->assertSame('api', $role->guard_name);
    }
}
