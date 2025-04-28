<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\RevokeRolePermissionsAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\RevokeRolePermissionsController;
use App\Containers\AppSection\Authorization\UI\API\Requests\RevokeRolePermissionsRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RevokeRolePermissionsController::class)]
final class RevokeRolePermissionsControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(RevokeRolePermissionsController::class);
        $revokeRolePermissionsRequest = RevokeRolePermissionsRequest::injectData();
        $actionMock = $this->mock(RevokeRolePermissionsAction::class);
        $actionMock->expects()->run($revokeRolePermissionsRequest)->andReturn(RoleFactory::new()->createOne());

        $controller($revokeRolePermissionsRequest, $actionMock);
    }
}
