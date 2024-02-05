<?php

namespace App\Ship\Tests\Unit\Parents\Tests\PhpUnit;

use App\Ship\Parents\Tests\PhpUnit\TestCase;
use App\Ship\Tests\ShipTestCase;
use Illuminate\Contracts\Foundation\Application;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversClass(TestCase::class)]
final class TestCaseTest extends ShipTestCase
{
    public function testCanCreateApplication(): void
    {
        $testCase = new FakeTestCase('test');
        $application = $testCase->createApplication();

        $this->assertInstanceOf(Application::class, $application);
    }
}

class FakeTestCase extends TestCase
{
}
