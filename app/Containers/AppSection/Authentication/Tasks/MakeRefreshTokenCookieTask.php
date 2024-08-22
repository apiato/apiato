<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task as ParentTask;
use Symfony\Component\HttpFoundation\Cookie;

class MakeRefreshTokenCookieTask extends ParentTask
{
    public function run(string $refreshToken): Cookie
    {
        return Cookie::create(
            'refreshToken',
            $refreshToken,
            config('apiato.api.refresh-expires-in'),
            null,
            null,
            config('session.secure'),
            config('session.http_only'),
        );
    }
}
