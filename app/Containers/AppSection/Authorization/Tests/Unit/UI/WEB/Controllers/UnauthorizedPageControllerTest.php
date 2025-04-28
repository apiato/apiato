<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\WEB\Controllers;

use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\WEB\Controllers\UnauthorizedPageController;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(UnauthorizedPageController::class)]
final class UnauthorizedPageControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectView(): void
    {
        $controller = app(UnauthorizedPageController::class);

        $view = $controller();

        $this->assertSame('appSection@authorization::unauthorized', $view->name());
    }
}
