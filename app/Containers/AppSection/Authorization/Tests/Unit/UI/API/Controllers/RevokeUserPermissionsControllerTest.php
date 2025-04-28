<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\RevokeUserPermissionsAction;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\RevokeUserPermissionsController;
use App\Containers\AppSection\Authorization\UI\API\Requests\RevokeUserPermissionsRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RevokeUserPermissionsController::class)]
final class RevokeUserPermissionsControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(RevokeUserPermissionsController::class);
        $revokeUserPermissionsRequest = RevokeUserPermissionsRequest::injectData();
        $actionMock = $this->mock(RevokeUserPermissionsAction::class);
        $actionMock->expects()->run($revokeUserPermissionsRequest)->andReturn(UserFactory::new()->createOne());

        $controller($revokeUserPermissionsRequest, $actionMock);
    }
}
