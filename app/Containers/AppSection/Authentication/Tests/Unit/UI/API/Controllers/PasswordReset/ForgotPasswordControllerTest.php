<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Controllers\PasswordReset;

use App\Containers\AppSection\Authentication\Actions\PasswordReset\ForgotPasswordAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\PasswordReset\ForgotPasswordController;
use App\Containers\AppSection\Authentication\UI\API\Requests\PasswordReset\ForgotPasswordRequest;
use PHPUnit\Framework\Attributes\CoversClass;

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

        $this->assertSame(202, $response->getStatusCode());
    }
}
