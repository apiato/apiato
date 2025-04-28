<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\GivePermissionsToUserAction;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\GivePermissionsToUserController;
use App\Containers\AppSection\Authorization\UI\API\Requests\GivePermissionsToUserRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(GivePermissionsToUserController::class)]
final class GivePermissionsToUserControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(GivePermissionsToUserController::class);
        $givePermissionsToUserRequest = GivePermissionsToUserRequest::injectData();
        $actionMock = $this->mock(GivePermissionsToUserAction::class);
        $actionMock->expects()->run($givePermissionsToUserRequest)->andReturn(UserFactory::new()->createOne());

        $controller($givePermissionsToUserRequest, $actionMock);
    }
}
