<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\WelcomeController;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(WelcomeController::class)]
final class WelcomeControllerTest extends UnitTestCase
{
    public function testUnversioned(): void
    {
        $controller = app(WelcomeController::class);

        $response = $controller->unversioned();

        $this->assertTrue($response->isOk());
        $this->assertSame('"Welcome to Apiato"', $response->getContent());
    }

    public function testVersioned(): void
    {
        $controller = app(WelcomeController::class);

        $response = $controller->versioned();

        $this->assertTrue($response->isOk());
        $this->assertSame('"Welcome to Apiato (API V1)"', $response->getContent());
    }
}
