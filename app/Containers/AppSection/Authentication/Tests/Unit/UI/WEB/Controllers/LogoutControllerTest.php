<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\WEB\Controllers;

use App\Containers\AppSection\Authentication\Actions\WebLogoutAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\WEB\Controllers\LogoutController;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LogoutRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(LogoutController::class)]
final class LogoutControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(LogoutController::class);
        $request = LogoutRequest::injectData();
        $actionSpy = $this->mock(WebLogoutAction::class);
        $actionSpy->expects()->run();

        $response = $controller->__invoke($request, $actionSpy);

        $this->assertTrue($response->isRedirect(route('home-page')));
    }
}
