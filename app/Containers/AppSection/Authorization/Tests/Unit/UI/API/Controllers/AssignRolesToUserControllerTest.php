<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\AssignRolesToUserAction;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\AssignRolesToUserController;
use App\Containers\AppSection\Authorization\UI\API\Requests\AssignRolesToUserRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(AssignRolesToUserController::class)]
final class AssignRolesToUserControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(AssignRolesToUserController::class);
        $assignRolesToUserRequest = AssignRolesToUserRequest::injectData();
        $actionMock = $this->mock(AssignRolesToUserAction::class);
        $actionMock->expects()->run($assignRolesToUserRequest)->andReturn(UserFactory::new()->createOne());

        $controller($assignRolesToUserRequest, $actionMock);
    }
}
