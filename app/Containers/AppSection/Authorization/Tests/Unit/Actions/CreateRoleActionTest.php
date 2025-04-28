<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\CreateRoleAction;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\CreateRoleRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(CreateRoleAction::class)]
final class CreateRoleActionTest extends UnitTestCase
{
    public function testCanCreateRole(): void
    {
        $createRoleRequest = CreateRoleRequest::injectData([
            'name'         => 'test-permission',
            'description'  => 'test-permission-description',
            'display_name' => 'test-permission-display-name',
        ]);
        $action = app(CreateRoleAction::class);

        $role = $action->run($createRoleRequest);

        $this->assertSame($createRoleRequest->name, $role->name);
        $this->assertSame($createRoleRequest->description, $role->description);
        $this->assertSame($createRoleRequest->display_name, $role->display_name);
        $this->assertSame('api', $role->guard_name);
    }
}
