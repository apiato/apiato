<?php

namespace App\Containers\AppSection\User\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\GetUserProfileAction;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Containers\AppSection\User\UI\API\Controllers\GetUserProfileController;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversClass(GetUserProfileController::class)]
final class GetUserProfileControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(GetUserProfileController::class);
        $actionMock = $this->mock(GetUserProfileAction::class);
        $actionMock->expects()->run()->andReturn(UserFactory::new()->createOne());

        $controller->__invoke($actionMock);
    }
}
