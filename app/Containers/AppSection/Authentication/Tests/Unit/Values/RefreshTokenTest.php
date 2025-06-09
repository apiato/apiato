<?php

declare(strict_types=1);

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

        self::assertSame(RefreshToken::cookieName(), $cookie->getName());
        self::assertSame($refreshToken->value(), $cookie->getValue());
        self::assertSame((int) config('appSection-authentication.refresh-tokens-expire-in'), $cookie->getExpiresTime());
        self::assertSame('/', $cookie->getPath());
        self::assertNull($cookie->getDomain());
        self::assertEquals(config('session.secure'), $cookie->isSecure());
        self::assertEquals(config('session.http_only'), $cookie->isHttpOnly());
    }

    public function testCanCreateFromRequest(): void
    {
        $request = (new class () extends Request {
        })::create(
            '',
            parameters: [
                'refresh_token' => fake()->sha256(),
            ],
        );

        $refreshToken = RefreshToken::createFrom($request);

        self::assertSame($request->input('refresh_token'), $refreshToken->value());
        self::assertNull($request->cookie(RefreshToken::cookieName()));
    }

    public function testCanCreateFromRequestWithCookie(): void
    {
        $request = (new class () extends Request {
        })::create(
            '',
            cookies: [
                RefreshToken::cookieName() => fake()->sha256(),
            ],
        );

        $refreshToken = RefreshToken::createFrom($request);

        self::assertSame($request->cookie(RefreshToken::cookieName()), $refreshToken->value());
        self::assertNull($request->input('refresh_token'));
    }
}
