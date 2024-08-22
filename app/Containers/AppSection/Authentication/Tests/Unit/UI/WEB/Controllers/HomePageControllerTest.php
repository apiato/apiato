<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\WEB\Controllers;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\WEB\Controllers\HomePageController;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(HomePageController::class)]
final class HomePageControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectView(): void
    {
        $controller = app(HomePageController::class);

        $view = $controller->__invoke();

        $this->assertSame('appSection@authentication::home', $view->name());
    }
}
