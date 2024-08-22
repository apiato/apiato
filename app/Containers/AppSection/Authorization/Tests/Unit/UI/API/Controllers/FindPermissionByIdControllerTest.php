<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\FindPermissionByIdAction;
use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\FindPermissionByIdController;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindPermissionByIdRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(FindPermissionByIdController::class)]
final class FindPermissionByIdControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(FindPermissionByIdController::class);
        $request = FindPermissionByIdRequest::injectData();
        $actionMock = $this->mock(FindPermissionByIdAction::class);
        $actionMock->expects()->run($request)->andReturn(PermissionFactory::new()->createOne());

        $controller->__invoke($request, $actionMock);
    }
}
