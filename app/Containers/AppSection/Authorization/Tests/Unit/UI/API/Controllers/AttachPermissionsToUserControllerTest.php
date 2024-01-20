<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\AttachPermissionsToUserAction;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\AttachPermissionsToUserController;
use App\Containers\AppSection\Authorization\UI\API\Requests\AttachPermissionsToUserRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(AttachPermissionsToUserController::class)]
final class AttachPermissionsToUserControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(AttachPermissionsToUserController::class);
        $request = AttachPermissionsToUserRequest::injectData();
        $actionMock = $this->mock(AttachPermissionsToUserAction::class);
        $actionMock->expects()->run($request)->andReturn(UserFactory::new()->createOne());

        $controller->__invoke($request, $actionMock);
    }
}
