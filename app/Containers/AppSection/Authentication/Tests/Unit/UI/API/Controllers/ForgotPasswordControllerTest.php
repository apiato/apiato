<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\ForgotPasswordAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\ForgotPasswordController;
use App\Containers\AppSection\Authentication\UI\API\Requests\ForgotPasswordRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(ForgotPasswordController::class)]
final class ForgotPasswordControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(ForgotPasswordController::class);
        $request = ForgotPasswordRequest::injectData();
        $actionMock = $this->mock(ForgotPasswordAction::class);
        $actionMock->expects()->run($request);

        $response = $controller->__invoke($request, $actionMock);

        $this->assertSame(204, $response->getStatusCode());
    }
}
