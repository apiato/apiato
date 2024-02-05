<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\ListUserRolesAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\ListUserRolesController;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListUserRolesRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(ListUserRolesController::class)]
final class ListUserRolesControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(ListUserRolesController::class);
        $request = ListUserRolesRequest::injectData();
        $actionMock = $this->mock(ListUserRolesAction::class);
        $actionMock->expects()->run($request)->andReturn(RoleFactory::new()->count(2)->create());

        $controller->__invoke($request, $actionMock);
    }
}
