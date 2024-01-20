<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\SendVerificationEmailAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\SendVerificationEmailController;
use App\Containers\AppSection\Authentication\UI\API\Requests\SendVerificationEmailRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(SendVerificationEmailController::class)]
final class SendVerificationEmailControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(SendVerificationEmailController::class);
        $request = SendVerificationEmailRequest::injectData();
        $actionMock = $this->mock(SendVerificationEmailAction::class);
        $actionMock->expects()->run($request);

        $controller->__invoke($request, $actionMock);
    }
}
