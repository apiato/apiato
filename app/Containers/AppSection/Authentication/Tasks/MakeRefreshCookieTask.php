<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task as ParentTask;
use Symfony\Component\HttpFoundation\Cookie;

class MakeRefreshCookieTask extends ParentTask
{
    public function run(string $refreshToken): Cookie
    {
        return cookie(
            'refreshToken',
            $refreshToken,
            config('apiato.api.refresh-expires-in'),
            null,
            null,
            config('session.secure'),
            true,
        );
    }
}
