<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task as ParentTask;
use Symfony\Component\HttpFoundation\Cookie;

final class MakeRefreshTokenCookieTask extends ParentTask
{
    public function run(string $refreshToken): Cookie
    {
        return Cookie::create(
            'refreshToken',
            $refreshToken,
            config('appSection-authentication.refresh-tokens-expire-in'),
            null,
            null,
            config('session.secure'),
            config('session.http_only'),
        );
    }
}
