<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\FindPermissionAction;
use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\FindPermissionController;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindPermissionRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(FindPermissionController::class)]
final class FindPermissionControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(FindPermissionController::class);
        $request = FindPermissionRequest::injectData();
        $actionMock = $this->mock(FindPermissionAction::class);
        $actionMock->expects()->run($request)->andReturn(PermissionFactory::new()->createOne());

        $controller->__invoke($request, $actionMock);
    }
}
