<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Values;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\LoginField;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(LoginField::class)]
final class LoginFieldTest extends UnitTestCase
{
    public function testCanCreateValue(): void
    {
        $loginField = new LoginField('email', ['required|email']);

        $this->assertSame('email', $loginField->name());
        $this->assertSame(['required|email'], $loginField->rules());
        $this->assertSame('email', (string) $loginField);
        $this->assertSame(['email' => ['required|email']], $loginField->toArray());
    }
}
