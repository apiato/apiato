<?php

namespace App\Containers\AppSection\Authentication\Values;

use App\Ship\Parents\Values\Value as ParentValue;
use Illuminate\Cookie\CookieJar;
use Symfony\Component\HttpFoundation\Cookie;

class AuthResult extends ParentValue
{
    public function __construct(
        public readonly Token $token,
        public readonly CookieJar|Cookie $refreshTokenCookie,
    ) {
    }
}
