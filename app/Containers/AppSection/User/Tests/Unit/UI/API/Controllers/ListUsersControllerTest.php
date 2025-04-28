<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\ListUsersAction;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Containers\AppSection\User\UI\API\Controllers\ListUsersController;
use App\Containers\AppSection\User\UI\API\Requests\ListUsersRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ListUsersController::class)]
final class ListUsersControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(ListUsersController::class);
        $listUsersRequest = ListUsersRequest::injectData();
        $actionMock = $this->mock(ListUsersAction::class);
        $actionMock->expects()->run()->andReturn(new LengthAwarePaginator([], 0, 1));

        $controller($listUsersRequest, $actionMock);
    }
}
