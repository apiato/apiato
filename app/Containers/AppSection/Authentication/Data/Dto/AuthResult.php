<?php

namespace App\Containers\AppSection\Authentication\Data\Dto;

use Apiato\Http\Resources\HasResourceKey;
use Apiato\Http\Resources\ResourceKeyAware;
use Symfony\Component\HttpFoundation\Cookie;

// TODO
final readonly class AuthResult implements ResourceKeyAware
{
    use HasResourceKey;

    public function __construct(
        public Token $token,
        public Cookie $refreshTokenCookie,
    ) {
    }

    public static function fake(): self
    {
        return new self(
            Token::fake(),
            new Cookie(
                'refreshToken',
                fake()->sha256(),
            ),
        );
    }
}
