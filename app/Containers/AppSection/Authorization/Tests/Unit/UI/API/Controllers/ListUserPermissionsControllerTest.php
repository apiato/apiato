<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\ListUserPermissionsAction;
use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\ListUserPermissionsController;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListUserPermissionsRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(ListUserPermissionsController::class)]
final class ListUserPermissionsControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(ListUserPermissionsController::class);
        $request = ListUserPermissionsRequest::injectData();
        $actionMock = $this->mock(ListUserPermissionsAction::class);
        $actionMock->expects()->run($request)->andReturn(PermissionFactory::new()->count(2)->create());

        $controller->__invoke($request, $actionMock);
    }
}
