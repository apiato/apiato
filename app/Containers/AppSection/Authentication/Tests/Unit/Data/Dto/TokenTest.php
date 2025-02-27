<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Data\Dto;

use App\Containers\AppSection\Authentication\Data\Dto\Token;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Component\HttpFoundation\Cookie;

#[CoversClass(Token::class)]
final class TokenTest extends UnitTestCase
{
    public function testCanCreateValue(): void
    {
        $value = new Token(
            fake()->word(),
            fake()->numberBetween(),
            fake()->sha256(),
            fake()->sha256(),
        );

        $this->assertSame('string', gettype($value->tokenType));
        $this->assertSame('integer', gettype($value->expiresIn));
        $this->assertSame('string', gettype($value->accessToken));
        $this->assertSame('string', gettype($value->refreshToken));
        $this->assertInstanceOf(Cookie::class, $value->refreshTokenCookie);
        $this->assertSame(Token::refreshTokenCookieName(), $value->refreshTokenCookie->getName());
        $this->assertSame($value->refreshToken, $value->refreshTokenCookie->getValue());
        $this->assertEquals(
            (int) config('appSection-authentication.refresh-tokens-expire-in'),
            $value->refreshTokenCookie->getExpiresTime(),
        );
        $this->assertEquals('/', $value->refreshTokenCookie->getPath());
        $this->assertNull($value->refreshTokenCookie->getDomain());
        $this->assertEquals(config('session.secure'), $value->refreshTokenCookie->isSecure());
        $this->assertEquals(config('session.http_only'), $value->refreshTokenCookie->isHttpOnly());
    }

    public function testCanCreateFakeValue(): void
    {
        $value = Token::fake();

        $this->assertNotEmpty($value->tokenType);
        $this->assertNotEmpty($value->accessToken);
        $this->assertNotEmpty($value->refreshToken);
        $this->assertInstanceOf(Cookie::class, $value->refreshTokenCookie);

        $value = Token::fake([
            'token_type' => 'type',
            'expires_in' => 123,
            'access_token' => 'access',
            'refresh_token' => 'refresh'
        ]);

        $this->assertSame('type', $value->tokenType);
        $this->assertSame(123, $value->expiresIn);
        $this->assertSame('access', $value->accessToken);
        $this->assertSame('refresh', $value->refreshToken);
        $this->assertInstanceOf(Cookie::class, $value->refreshTokenCookie);
    }
}
