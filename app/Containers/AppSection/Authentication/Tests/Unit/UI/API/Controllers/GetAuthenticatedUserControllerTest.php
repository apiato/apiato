<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\GetAuthenticatedUserAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\GetAuthenticatedUserController;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use Illuminate\Contracts\Auth\Authenticatable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(GetAuthenticatedUserController::class)]
final class GetAuthenticatedUserControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $controller = app(GetAuthenticatedUserController::class);
        $actionMock = $this->mock(GetAuthenticatedUserAction::class);
        $actionMock->expects()->run();

        $controller->__invoke($actionMock);
    }
}
