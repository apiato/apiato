<?php

namespace App\Containers\AppSection\Authentication\Values;

use App\Ship\Parents\Requests\Request;
use App\Ship\Parents\Values\Value as ParentValue;
use Symfony\Component\HttpFoundation\Cookie;
use Webmozart\Assert\Assert;

final readonly class RefreshToken extends ParentValue
{
    private function __construct(
        private string $refreshToken,
    ) {
    }

    public static function createFrom(Request $request): self
    {
        return self::create(
            $request->input(
                'refresh_token',
                $request->cookie(self::cookieName()),
            ),
        );
    }

    public static function create(string $refreshToken): self
    {
        Assert::stringNotEmpty($refreshToken);

        return new self($refreshToken);
    }

    public static function cookieName(): string
    {
        return 'refreshToken';
    }

    public function value(): string
    {
        return $this->refreshToken;
    }

    public function asCookie(): Cookie
    {
        return Cookie::create(
            self::cookieName(),
            $this->refreshToken,
            config('appSection-authentication.refresh-tokens-expire-in'),
            null,
            null,
            config('session.secure'),
            config('session.http_only'),
        );
    }
}
