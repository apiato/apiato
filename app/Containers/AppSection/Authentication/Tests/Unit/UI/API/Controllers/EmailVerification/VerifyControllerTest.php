<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Controllers\EmailVerification;

use App\Containers\AppSection\Authentication\Actions\EmailVerification\VerifyAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\EmailVerification\VerifyController;
use App\Containers\AppSection\Authentication\UI\API\Requests\EmailVerification\VerifyRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(VerifyController::class)]
final class VerifyControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(VerifyController::class);
        $request = VerifyRequest::injectData();
        $actionMock = $this->mock(VerifyAction::class);
        $actionMock->expects()->run($request);

        $controller->__invoke($request, $actionMock);
    }
}
