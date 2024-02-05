<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Values;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\AuthResult;
use App\Containers\AppSection\Authentication\Values\Token;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Symfony\Component\HttpFoundation\Cookie;

#[Group('authentication')]
#[CoversClass(AuthResult::class)]
final class AuthResultTest extends UnitTestCase
{
    public function testCanCreateValue(): void
    {
        $value = new AuthResult(
            Token::fake(),
            new Cookie(
                'refreshToken',
                fake()->sha256(),
            ),
        );

        $this->assertInstanceOf(Token::class, $value->token);
        $this->assertInstanceOf(Cookie::class, $value->refreshTokenCookie);
    }

    public function testCanCreateFakeValue(): void
    {
        $value = AuthResult::fake();

        $this->assertInstanceOf(Token::class, $value->token);
        $this->assertInstanceOf(Cookie::class, $value->refreshTokenCookie);
    }
}
