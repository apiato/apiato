<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\RegisterUserAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\RegisterUserController;
use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterUserRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(RegisterUserController::class)]
final class RegisterUserControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(RegisterUserController::class);
        $request = RegisterUserRequest::injectData();
        $actionMock = $this->mock(RegisterUserAction::class);
        $actionMock->expects()->transactionalRun($request);

        $controller->__invoke($request, $actionMock);
    }
}
