<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Values;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\LoginField;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(LoginField::class)]
final class LoginFieldTest extends UnitTestCase
{
    public function testCanCreateValue(): void
    {
        $loginAttribute = new LoginField('email', ['required|email']);

        $this->assertSame('email', $loginAttribute->name());
        $this->assertSame(['required|email'], $loginAttribute->rules());
        $this->assertSame('email', (string) $loginAttribute);
        $this->assertSame(['email' => ['required|email']], $loginAttribute->toArray());
    }
}
