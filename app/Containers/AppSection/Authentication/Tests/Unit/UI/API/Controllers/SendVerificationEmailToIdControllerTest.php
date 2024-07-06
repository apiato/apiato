<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\SendVerificationEmailToIdAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\SendVerificationEmailToIdController;
use App\Containers\AppSection\Authentication\UI\API\Requests\SendVerificationEmailToIdRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(SendVerificationEmailToIdController::class)]
final class SendVerificationEmailToIdControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(SendVerificationEmailToIdController::class);
        $request = SendVerificationEmailToIdRequest::injectData();
        $actionMock = $this->mock(SendVerificationEmailToIdAction::class);
        $actionMock->expects()->run($request);

        $controller->__invoke($request);
    }
}
