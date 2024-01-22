<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\CreateRoleAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\CreateRoleController;
use App\Containers\AppSection\Authorization\UI\API\Requests\CreateRoleRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(CreateRoleController::class)]
final class CreateRoleControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(CreateRoleController::class);
        $request = CreateRoleRequest::injectData();
        $actionMock = $this->mock(CreateRoleAction::class);
        $actionMock->expects()->run($request)->andReturn(RoleFactory::new()->createOne());

        $response = $controller->__invoke($request, $actionMock);

        $this->assertSame(201, $response->getStatusCode());
    }
}
