<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\WEB\Controllers;

use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\WEB\Controllers\UnauthorizedPageController;
use Illuminate\Support\Facades\View;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(UnauthorizedPageController::class)]
final class UnauthorizedPageControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectView(): void
    {
        View::partialMock()
            ->allows('make')
            ->once()
            ->with('appSection@authorization::unauthorized');

        $controller = app(UnauthorizedPageController::class);

        $controller->__invoke();
    }
}
