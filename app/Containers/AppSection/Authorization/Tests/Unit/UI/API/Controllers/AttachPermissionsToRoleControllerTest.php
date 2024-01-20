<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\AttachPermissionsToRoleAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\AttachPermissionsToRoleController;
use App\Containers\AppSection\Authorization\UI\API\Requests\AttachPermissionsToRoleRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(AttachPermissionsToRoleController::class)]
final class AttachPermissionsToRoleControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(AttachPermissionsToRoleController::class);
        $request = AttachPermissionsToRoleRequest::injectData();
        $actionMock = $this->mock(AttachPermissionsToRoleAction::class);
        $actionMock->expects()->run($request)->andReturn(RoleFactory::new()->createOne());

        $controller->__invoke($request, $actionMock);
    }
}
