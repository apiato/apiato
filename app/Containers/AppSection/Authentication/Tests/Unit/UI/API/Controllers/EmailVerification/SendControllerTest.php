<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Controllers\EmailVerification;

use App\Containers\AppSection\Authentication\Actions\EmailVerification\SendAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\EmailVerification\SendController;
use App\Containers\AppSection\Authentication\UI\API\Requests\EmailVerification\SendRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(SendController::class)]
final class SendControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(SendController::class);
        $request = SendRequest::injectData();
        $actionMock = $this->mock(SendAction::class);
        $actionMock->expects()->run($request);

        $controller->__invoke($request, $actionMock);
    }
}
