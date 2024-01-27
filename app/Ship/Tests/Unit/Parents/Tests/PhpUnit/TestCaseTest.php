<?php

namespace App\Ship\Tests\Unit\Parents\Tests\PhpUnit;

use App\Ship\Tests\TestCase;
use Illuminate\Contracts\Foundation\Application;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversClass(\App\Ship\Parents\Tests\PhpUnit\TestCase::class)]
final class TestCaseTest extends TestCase
{
    public function testCanCreateApplication(): void
    {
        $testCase = new FakeTestCase('test');
        $application = $testCase->createApplication();

        $this->assertInstanceOf(Application::class, $application);
    }
}

class FakeTestCase extends \App\Ship\Parents\Tests\PhpUnit\TestCase
{
}
