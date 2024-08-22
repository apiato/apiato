<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\VerifyEmailAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\VerifyEmailController;
use App\Containers\AppSection\Authentication\UI\API\Requests\VerifyEmailRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(VerifyEmailController::class)]
final class VerifyEmailControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(VerifyEmailController::class);
        $request = VerifyEmailRequest::injectData();
        $actionMock = $this->mock(VerifyEmailAction::class);
        $actionMock->expects()->run($request);

        $controller->__invoke($request, $actionMock);
    }
}
