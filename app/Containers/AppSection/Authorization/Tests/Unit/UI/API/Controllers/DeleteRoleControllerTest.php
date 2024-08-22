<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\DeleteRoleAction;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\DeleteRoleController;
use App\Containers\AppSection\Authorization\UI\API\Requests\DeleteRoleRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(DeleteRoleController::class)]
final class DeleteRoleControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(DeleteRoleController::class);
        $request = DeleteRoleRequest::injectData();
        $actionMock = $this->mock(DeleteRoleAction::class);
        $actionMock->expects()->run($request);

        $response = $controller->__invoke($request, $actionMock);

        $this->assertSame(204, $response->getStatusCode());
    }
}
