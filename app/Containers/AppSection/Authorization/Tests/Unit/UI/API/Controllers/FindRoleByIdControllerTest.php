<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\FindRoleByIdAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\FindRoleByIdController;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindRoleByIdRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(FindRoleByIdController::class)]
final class FindRoleByIdControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(FindRoleByIdController::class);
        $findRoleByIdRequest = FindRoleByIdRequest::injectData();
        $actionMock = $this->mock(FindRoleByIdAction::class);
        $actionMock->expects()->run($findRoleByIdRequest)->andReturn(RoleFactory::new()->createOne());

        $controller($findRoleByIdRequest, $actionMock);
    }
}
