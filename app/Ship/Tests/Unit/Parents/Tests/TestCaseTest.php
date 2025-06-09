<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Parents\Tests;

use App\Ship\Parents\Tests\TestCase;
use App\Ship\Tests\ShipTestCase;
use Illuminate\Contracts\Foundation\Application;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(TestCase::class)]
final class TestCaseTest extends ShipTestCase
{
    public function testCanCreateApplication(): void
    {
        $fakeTestCase = new FakeTestCase('test');
        $application = $fakeTestCase->createApplication();

        self::assertInstanceOf(Application::class, $application);
    }
}
