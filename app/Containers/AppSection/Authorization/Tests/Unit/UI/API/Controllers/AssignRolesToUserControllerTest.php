<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\AssignRolesToUserAction;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\AssignRolesToUserController;
use App\Containers\AppSection\Authorization\UI\API\Requests\AssignRolesToUserRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(AssignRolesToUserController::class)]
final class AssignRolesToUserControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(AssignRolesToUserController::class);
        $request = AssignRolesToUserRequest::injectData();
        $actionMock = $this->mock(AssignRolesToUserAction::class);
        $actionMock->expects()->run($request)->andReturn(UserFactory::new()->createOne());

        $controller->__invoke($request, $actionMock);
    }
}
