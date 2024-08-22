<?php

namespace App\Ship\Tests\Unit\Commands;

use App\Ship\Commands\HelloWorldCommand;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversClass(HelloWorldCommand::class)]
final class HelloWorldCommandTest extends ShipTestCase
{
    public function testCommand(): void
    {
        $this->artisan('hello:world')
            ->expectsOutput('Hello World!')
            ->assertSuccessful();
    }
}
