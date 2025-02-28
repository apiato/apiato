<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\WEB\Controllers;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\WEB\Controllers\LoginController;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(LoginController::class)]
final class LoginControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectView(): void
    {
        $controller = app(LoginController::class);

        $view = $controller->showForm();

        $this->assertSame('appSection@authentication::login', $view->name());
    }
}
