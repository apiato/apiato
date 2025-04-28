<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\SyncRolePermissionsAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\SyncRolePermissionsController;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncRolePermissionsRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(SyncRolePermissionsController::class)]
final class SyncRolePermissionsControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(SyncRolePermissionsController::class);
        $syncRolePermissionsRequest = SyncRolePermissionsRequest::injectData();
        $actionMock = $this->mock(SyncRolePermissionsAction::class);
        $actionMock->expects()->run($syncRolePermissionsRequest)->andReturn(RoleFactory::new()->createOne());

        $controller($syncRolePermissionsRequest, $actionMock);
    }
}
