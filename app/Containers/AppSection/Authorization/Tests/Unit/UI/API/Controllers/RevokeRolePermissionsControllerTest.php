<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\RevokeRolePermissionsAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\RevokeRolePermissionsController;
use App\Containers\AppSection\Authorization\UI\API\Requests\RevokeRolePermissionsRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(RevokeRolePermissionsController::class)]
final class RevokeRolePermissionsControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(RevokeRolePermissionsController::class);
        $request = RevokeRolePermissionsRequest::injectData();
        $actionMock = $this->mock(RevokeRolePermissionsAction::class);
        $actionMock->expects()->run($request)->andReturn(RoleFactory::new()->createOne());

        $controller->__invoke($request, $actionMock);
    }
}
