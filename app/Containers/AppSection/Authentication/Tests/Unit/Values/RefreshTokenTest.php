<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Values;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\RefreshToken;
use App\Ship\Parents\Requests\Request;
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

    public function testCanCreateFromRequest(): void
    {
        $request = (new class extends Request {
        })::create(
            '',
            parameters: [
                'refresh_token' => fake()->sha256(),
            ],
        );

        $refreshToken = RefreshToken::createFrom($request);

        $this->assertSame($request->input('refresh_token'), $refreshToken->value());
        $this->assertNull($request->cookie(RefreshToken::cookieName()));
    }

    public function testCanCreateFromRequestWithCookie(): void
    {
        $request = (new class extends Request {
        })::create(
            '',
            cookies: [
                RefreshToken::cookieName() => fake()->sha256(),
            ],
        );

        $refreshToken = RefreshToken::createFrom($request);

        $this->assertSame($request->cookie(RefreshToken::cookieName()), $refreshToken->value());
        $this->assertNull($request->input('refresh_token'));
    }
}
