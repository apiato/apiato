<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Controllers\PasswordReset;

use App\Containers\AppSection\Authentication\Actions\PasswordReset\ResetPasswordAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\PasswordReset\ResetPasswordController;
use App\Containers\AppSection\Authentication\UI\API\Requests\PasswordReset\ResetPasswordRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ResetPasswordController::class)]
final class ResetPasswordControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(ResetPasswordController::class);
        $actionMock = $this->mock(ResetPasswordAction::class);
        $request = ResetPasswordRequest::injectData();
        $actionMock->expects()->run($request);

        $controller->__invoke($request, $actionMock);
    }
}
