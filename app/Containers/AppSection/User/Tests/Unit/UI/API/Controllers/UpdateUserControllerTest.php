<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\UpdateUserAction;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Containers\AppSection\User\UI\API\Controllers\UpdateUserController;
use App\Containers\AppSection\User\UI\API\Requests\UpdateUserRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(UpdateUserController::class)]
final class UpdateUserControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(UpdateUserController::class);
        $updateUserRequest = UpdateUserRequest::injectData();
        $actionMock = $this->mock(UpdateUserAction::class);
        $actionMock->expects()->run($updateUserRequest)->andReturn(UserFactory::new()->createOne());

        $controller($updateUserRequest, $actionMock);
    }
}
