<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\FindRoleByIdAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\FindRoleByIdController;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindRoleByIdRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(FindRoleByIdController::class)]
final class FindRoleByIdControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(FindRoleByIdController::class);
        $request = FindRoleByIdRequest::injectData();
        $actionMock = $this->mock(FindRoleByIdAction::class);
        $actionMock->expects()->run($request)->andReturn(RoleFactory::new()->createOne());

        $controller->__invoke($request, $actionMock);
    }
}
