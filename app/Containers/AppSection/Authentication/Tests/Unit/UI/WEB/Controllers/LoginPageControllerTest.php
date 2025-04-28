<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\WEB\Controllers;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\WEB\Controllers\LoginPageController;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(LoginPageController::class)]
final class LoginPageControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectView(): void
    {
        $controller = app(LoginPageController::class);

        $view = $controller();

        $this->assertSame('appSection@authentication::login', $view->name());
    }
}
