<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\ListUserRolesAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\ListUserRolesController;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListUserRolesRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ListUserRolesController::class)]
final class ListUserRolesControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(ListUserRolesController::class);
        $listUserRolesRequest = ListUserRolesRequest::injectData();
        $actionMock = $this->mock(ListUserRolesAction::class);
        $actionMock->expects()->run($listUserRolesRequest)->andReturn(RoleFactory::new()->count(2)->create());

        $controller($listUserRolesRequest, $actionMock);
    }
}
