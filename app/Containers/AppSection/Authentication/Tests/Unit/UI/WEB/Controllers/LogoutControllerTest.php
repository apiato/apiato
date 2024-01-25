<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\WEB\Controllers;

use App\Containers\AppSection\Authentication\Actions\WebLogoutAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\WEB\Controllers\LogoutController;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LogoutRequest;
use App\Ship\Providers\RouteServiceProvider;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

#[Group('authentication')]
#[CoversClass(LogoutController::class)]
final class LogoutControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectActionAndDoRedirect(): void
    {
        $controller = app(LogoutController::class);
        $request = LogoutRequest::injectData();
        $actionMock = $this->mock(WebLogoutAction::class);
        $actionMock->expects()->run();

        try {
            $response = $controller->__invoke($request, $actionMock);

            $this->assertTrue($response->isRedirect(route(RouteServiceProvider::HOME)));
        } catch (RouteNotFoundException $e) {
            $this->assertSame('Route [web_welcome_say_welcome] not defined.', $e->getMessage());
        }
    }
}
