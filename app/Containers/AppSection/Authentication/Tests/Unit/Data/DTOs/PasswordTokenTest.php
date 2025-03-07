<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Data\DTOs;

use App\Containers\AppSection\Authentication\Data\DTOs\PasswordToken;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Component\HttpFoundation\Cookie;

#[CoversClass(PasswordToken::class)]
final class PasswordTokenTest extends UnitTestCase
{
    public function testCanBeInstantiated(): void
    {
        $value = new PasswordToken(
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
        $this->assertSame(PasswordToken::refreshTokenCookieName(), $value->refreshTokenCookie->getName());
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
}
