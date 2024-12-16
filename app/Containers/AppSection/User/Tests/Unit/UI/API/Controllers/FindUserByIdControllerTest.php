<?php

namespace App\Containers\AppSection\User\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\FindUserByIdAction;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Containers\AppSection\User\UI\API\Controllers\FindUserByIdController;
use App\Containers\AppSection\User\UI\API\Requests\FindUserByIdRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(FindUserByIdController::class)]
final class FindUserByIdControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(FindUserByIdController::class);
        $request = FindUserByIdRequest::injectData();
        $actionMock = $this->mock(FindUserByIdAction::class);
        $actionMock->expects()->run($request)->andReturn(UserFactory::new()->createOne());

        $controller->__invoke($request, $actionMock);
    }
}
