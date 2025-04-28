<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\CreateRoleAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\CreateRoleController;
use App\Containers\AppSection\Authorization\UI\API\Requests\CreateRoleRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(CreateRoleController::class)]
final class CreateRoleControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(CreateRoleController::class);
        $createRoleRequest = CreateRoleRequest::injectData();
        $actionMock = $this->mock(CreateRoleAction::class);
        $actionMock->expects()->run($createRoleRequest)->andReturn(RoleFactory::new()->createOne());

        $response = $controller($createRoleRequest, $actionMock);

        $this->assertSame(201, $response->getStatusCode());
    }
}
