<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\WEB\Controllers;

use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\WEB\Controllers\UnauthorizedPageController;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(UnauthorizedPageController::class)]
final class UnauthorizedPageControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectView(): void
    {
        $controller = app(UnauthorizedPageController::class);

        $view = $controller->__invoke();

        $this->assertSame('appSection@authorization::unauthorized', $view->name());
    }
}
