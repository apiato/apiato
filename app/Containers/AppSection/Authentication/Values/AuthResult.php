<?php

namespace App\Containers\AppSection\Authentication\Values;

use App\Ship\Parents\Values\Value as ParentValue;
use Symfony\Component\HttpFoundation\Cookie;

class AuthResult extends ParentValue
{
    public function __construct(
        public readonly Token $token,
        public readonly Cookie $refreshTokenCookie,
    ) {
    }

    public static function fake(): self
    {
        return new self(
            token: Token::fake(),
            refreshTokenCookie: new Cookie(
                name: 'refreshToken',
                value: fake()->sha256(),
            ),
        );
    }
}
