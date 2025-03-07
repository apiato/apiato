<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Values;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\RefreshToken;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RefreshToken::class)]
final class RefreshTokenTest extends UnitTestCase
{
    public function testCanCreateCookieProperly(): void
    {
        $refreshToken = RefreshToken::create(fake()->sha256());

        $cookie = $refreshToken->asCookie();

        $this->assertSame(RefreshToken::cookieName(), $cookie->getName());
        $this->assertSame($refreshToken->value(), $cookie->getValue());
        $this->assertEquals(
            (int) config('appSection-authentication.refresh-tokens-expire-in'),
            $cookie->getExpiresTime(),
        );
        $this->assertEquals('/', $cookie->getPath());
        $this->assertNull($cookie->getDomain());
        $this->assertEquals(config('session.secure'), $cookie->isSecure());
        $this->assertEquals(config('session.http_only'), $cookie->isHttpOnly());
    }
}
