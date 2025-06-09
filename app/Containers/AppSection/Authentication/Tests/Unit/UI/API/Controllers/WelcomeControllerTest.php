<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\WelcomeController;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(WelcomeController::class)]
final class WelcomeControllerTest extends UnitTestCase
{
    public function testUnversioned(): void
    {
        $controller = app(WelcomeController::class);

        $response = $controller->unversioned();

        self::assertTrue($response->isOk());
        self::assertSame('"Welcome to Apiato"', $response->getContent());
    }

    public function testVersioned(): void
    {
        $controller = app(WelcomeController::class);

        $response = $controller->versioned();

        self::assertTrue($response->isOk());
        self::assertSame('"Welcome to Apiato (API V1)"', $response->getContent());
    }
}
