<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\ResetPasswordAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\ResetPasswordController;
use App\Containers\AppSection\Authentication\UI\API\Requests\ResetPasswordRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ResetPasswordController::class)]
final class ResetPasswordControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(ResetPasswordController::class);
        $actionMock = $this->mock(ResetPasswordAction::class);
        $resetPasswordRequest = ResetPasswordRequest::injectData();
        $actionMock->expects()->run($resetPasswordRequest);

        $controller($resetPasswordRequest, $actionMock);
    }
}
