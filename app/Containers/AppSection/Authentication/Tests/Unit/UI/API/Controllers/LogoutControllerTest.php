<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\ApiLogoutAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\LogoutController;
use App\Containers\AppSection\Authentication\UI\API\Requests\LogoutRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(LogoutController::class)]
final class LogoutControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $actionMock = $this->mock(ApiLogoutAction::class);
        $controller = app(LogoutController::class);
        $request = LogoutRequest::injectData();

        $actionMock->expects()->run($request);

        $controller->__invoke($request, $actionMock);
    }
}
