<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Values;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\IncomingLoginField;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(IncomingLoginField::class)]
final class IncomingLoginFieldTest extends UnitTestCase
{
    public function testCanCreateValue(): void
    {
        $value = new IncomingLoginField('email', 'gandalf@the.grey');

        $this->assertSame('email', $value->name);
        $this->assertSame('gandalf@the.grey', $value->value);
    }
}
