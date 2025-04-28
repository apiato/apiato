<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\ForgotPasswordAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\ForgotPasswordController;
use App\Containers\AppSection\Authentication\UI\API\Requests\ForgotPasswordRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ForgotPasswordController::class)]
final class ForgotPasswordControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(ForgotPasswordController::class);
        $forgotPasswordRequest = ForgotPasswordRequest::injectData();
        $actionMock = $this->mock(ForgotPasswordAction::class);
        $actionMock->expects()->run($forgotPasswordRequest);

        $response = $controller($forgotPasswordRequest, $actionMock);

        $this->assertSame(204, $response->getStatusCode());
    }
}
