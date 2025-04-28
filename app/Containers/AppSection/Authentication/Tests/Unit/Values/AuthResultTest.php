<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Values;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\AuthResult;
use App\Containers\AppSection\Authentication\Values\Token;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Component\HttpFoundation\Cookie;

#[CoversClass(AuthResult::class)]
final class AuthResultTest extends UnitTestCase
{
    public function testCanCreateValue(): void
    {
        $authResult = new AuthResult(
            Token::fake(),
            new Cookie(
                'refreshToken',
                fake()->sha256(),
            ),
        );

        $this->assertInstanceOf(Token::class, $authResult->token);
        $this->assertInstanceOf(Cookie::class, $authResult->refreshTokenCookie);
    }

    public function testCanCreateFakeValue(): void
    {
        $authResult = AuthResult::fake();

        $this->assertInstanceOf(Token::class, $authResult->token);
        $this->assertInstanceOf(Cookie::class, $authResult->refreshTokenCookie);
    }
}
