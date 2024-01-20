<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\SyncPermissionsOnRoleAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\SyncPermissionOnRoleController;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncPermissionsOnRoleRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(SyncPermissionOnRoleController::class)]
final class SyncPermissionOnRoleControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(SyncPermissionOnRoleController::class);
        $request = SyncPermissionsOnRoleRequest::injectData();
        $actionMock = $this->mock(SyncPermissionsOnRoleAction::class);
        $actionMock->expects()->run($request)->andReturn(RoleFactory::new()->createOne());

        $controller->__invoke($request, $actionMock);
    }
}
