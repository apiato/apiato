<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\DetachPermissionsFromRoleAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\DetachPermissionsFromRoleController;
use App\Containers\AppSection\Authorization\UI\API\Requests\DetachPermissionsFromRoleRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(DetachPermissionsFromRoleController::class)]
final class DetachPermissionsFromRoleControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(DetachPermissionsFromRoleController::class);
        $request = DetachPermissionsFromRoleRequest::injectData();
        $actionMock = $this->mock(DetachPermissionsFromRoleAction::class);
        $actionMock->expects()->run($request)->andReturn(RoleFactory::new()->createOne());

        $controller->__invoke($request, $actionMock);
    }
}
