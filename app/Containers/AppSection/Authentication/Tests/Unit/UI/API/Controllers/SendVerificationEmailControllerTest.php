<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\SendVerificationEmailAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\SendVerificationEmailController;
use App\Containers\AppSection\Authentication\UI\API\Requests\SendVerificationEmailRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(SendVerificationEmailController::class)]
final class SendVerificationEmailControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(SendVerificationEmailController::class);
        $sendVerificationEmailRequest = SendVerificationEmailRequest::injectData();
        $actionMock = $this->mock(SendVerificationEmailAction::class);
        $actionMock->expects()->run($sendVerificationEmailRequest);

        $controller($sendVerificationEmailRequest, $actionMock);
    }
}
