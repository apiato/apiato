<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\DeleteRoleAction;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\DeleteRoleController;
use App\Containers\AppSection\Authorization\UI\API\Requests\DeleteRoleRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(DeleteRoleController::class)]
final class DeleteRoleControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(DeleteRoleController::class);
        $deleteRoleRequest = DeleteRoleRequest::injectData();
        $actionMock = $this->mock(DeleteRoleAction::class);
        $actionMock->expects()->run($deleteRoleRequest);

        $response = $controller($deleteRoleRequest, $actionMock);

        $this->assertSame(204, $response->getStatusCode());
    }
}
