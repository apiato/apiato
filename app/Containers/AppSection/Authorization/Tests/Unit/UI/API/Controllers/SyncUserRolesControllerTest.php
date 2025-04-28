<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authorization\Actions\SyncUserRolesAction;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Controllers\SyncUserRolesController;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncUserRolesRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(SyncUserRolesController::class)]
final class SyncUserRolesControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(SyncUserRolesController::class);
        $syncUserRolesRequest = SyncUserRolesRequest::injectData();
        $actionMock = $this->mock(SyncUserRolesAction::class);
        $actionMock->expects()->run($syncUserRolesRequest)->andReturn(UserFactory::new()->createOne());

        $controller($syncUserRolesRequest, $actionMock);
    }
}
