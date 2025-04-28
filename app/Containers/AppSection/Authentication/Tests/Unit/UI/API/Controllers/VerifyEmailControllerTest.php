<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\VerifyEmailAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\VerifyEmailController;
use App\Containers\AppSection\Authentication\UI\API\Requests\VerifyEmailRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(VerifyEmailController::class)]
final class VerifyEmailControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(VerifyEmailController::class);
        $verifyEmailRequest = VerifyEmailRequest::injectData();
        $actionMock = $this->mock(VerifyEmailAction::class);
        $actionMock->expects()->run($verifyEmailRequest);

        $controller($verifyEmailRequest, $actionMock);
    }
}
