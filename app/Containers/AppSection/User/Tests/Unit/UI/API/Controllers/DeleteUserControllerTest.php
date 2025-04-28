<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\DeleteUserAction;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Containers\AppSection\User\UI\API\Controllers\DeleteUserController;
use App\Containers\AppSection\User\UI\API\Requests\DeleteUserRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(DeleteUserController::class)]
final class DeleteUserControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(DeleteUserController::class);
        $deleteUserRequest = DeleteUserRequest::injectData();
        $actionMock = $this->mock(DeleteUserAction::class);
        $actionMock->expects()->run($deleteUserRequest);

        $controller($deleteUserRequest, $actionMock);
    }
}
