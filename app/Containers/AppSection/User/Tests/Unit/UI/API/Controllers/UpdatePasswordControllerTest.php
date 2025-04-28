<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\UpdatePasswordAction;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Containers\AppSection\User\UI\API\Controllers\UpdatePasswordController;
use App\Containers\AppSection\User\UI\API\Requests\UpdatePasswordRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(UpdatePasswordController::class)]
final class UpdatePasswordControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(UpdatePasswordController::class);
        $updatePasswordRequest = UpdatePasswordRequest::injectData();
        $actionMock = $this->mock(UpdatePasswordAction::class);
        $actionMock->expects()->run($updatePasswordRequest)->andReturn(UserFactory::new()->createOne());

        $controller($updatePasswordRequest, $actionMock);
    }
}
