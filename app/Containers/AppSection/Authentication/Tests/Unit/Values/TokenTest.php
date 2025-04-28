<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Values;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\Token;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Token::class)]
final class TokenTest extends UnitTestCase
{
    public function testCanCreateValue(): void
    {
        $token = new Token(fake()->word(), fake()->numberBetween(), fake()->sha256(), fake()->sha256());

        $this->assertSame('string', \gettype($token->tokenType));
        $this->assertSame('integer', \gettype($token->expiresIn));
        $this->assertSame('string', \gettype($token->accessToken));
        $this->assertSame('string', \gettype($token->refreshToken));
    }

    public function testCanCreateFakeValue(): void
    {
        $token = Token::fake();

        $this->assertSame('string', \gettype($token->tokenType));
        $this->assertSame('integer', \gettype($token->expiresIn));
        $this->assertSame('string', \gettype($token->accessToken));
        $this->assertSame('string', \gettype($token->refreshToken));
    }
}
