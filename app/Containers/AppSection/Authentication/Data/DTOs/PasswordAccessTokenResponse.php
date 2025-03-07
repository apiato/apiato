<?php

namespace App\Containers\AppSection\Authentication\Data\DTOs;

use Apiato\Http\Resources\HasResourceKey;
use Apiato\Http\Resources\ResourceKeyAware;
use Symfony\Component\HttpFoundation\Cookie;
use Webmozart\Assert\Assert;

final readonly class PasswordAccessTokenResponse implements ResourceKeyAware
{
    use HasResourceKey;

    public Cookie $refreshTokenCookie;

    public function __construct(
        public string $tokenType,
        public int $expiresIn,
        public string $accessToken,
        public string $refreshToken,
    ) {
        Assert::stringNotEmpty($this->tokenType);
        Assert::greaterThan($this->expiresIn, 0);
        Assert::stringNotEmpty($this->accessToken);
        Assert::stringNotEmpty($this->refreshToken);
        $this->refreshTokenCookie = $this->createRefreshTokenCookie();
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['token_type'],
            $data['expires_in'],
            $data['access_token'],
            $data['refresh_token'],
        );
    }

    private function createRefreshTokenCookie(): Cookie
    {
        return Cookie::create(
            self::refreshTokenCookieName(),
            $this->refreshToken,
            config('appSection-authentication.refresh-tokens-expire-in'),
            null,
            null,
            config('session.secure'),
            config('session.http_only'),
        );
    }

    public static function refreshTokenCookieName(): string
    {
        return 'refreshToken';
    }
}
