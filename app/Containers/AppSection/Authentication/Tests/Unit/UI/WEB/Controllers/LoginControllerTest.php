<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\WEB\Controllers;

use App\Containers\AppSection\Authentication\Actions\WebLoginAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\WEB\Controllers\LoginController;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(LoginController::class)]
final class LoginControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(LoginController::class);
        $request = LoginRequest::injectData();
        $actionMock = $this->mock(WebLoginAction::class);
        $actionMock->expects()->run($request);

        $controller->__invoke($request, $actionMock);
    }
}
