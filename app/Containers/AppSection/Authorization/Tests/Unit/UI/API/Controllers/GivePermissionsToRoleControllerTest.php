<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\GivePermissionsToRoleAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\GivePermissionsToRoleController;
use App\Containers\AppSection\Authorization\UI\API\Requests\GivePermissionsToRoleRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(GivePermissionsToRoleController::class)]
final class GivePermissionsToRoleControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(GivePermissionsToRoleController::class);
        $givePermissionsToRoleRequest = GivePermissionsToRoleRequest::injectData();
        $actionMock = $this->mock(GivePermissionsToRoleAction::class);
        $actionMock->expects()->run($givePermissionsToRoleRequest)->andReturn(RoleFactory::new()->createOne());

        $controller($givePermissionsToRoleRequest, $actionMock);
    }
}
