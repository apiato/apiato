<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\ResetPasswordAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\ResetPasswordController;
use App\Containers\AppSection\Authentication\UI\API\Requests\ResetPasswordRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(ResetPasswordController::class)]
final class ResetPasswordControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $actionMock = $this->mock(ResetPasswordAction::class);
        $controller = app(ResetPasswordController::class);
        $request = ResetPasswordRequest::injectData();

        $actionMock->expects()->run($request);

        $controller->__invoke($request, $actionMock);
    }
}
