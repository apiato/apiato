<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Cookie\CookieJar;
use Symfony\Component\HttpFoundation\Cookie;

class MakeRefreshCookieTask extends ParentTask
{
    public function run(string $refreshToken): CookieJar|Cookie|Application
    {
        return cookie(
            'refreshToken',
            $refreshToken,
            config('apiato.api.refresh-expires-in'),
            null,
            null,
            config('session.secure'),
            true // Save the refresh token in a HttpOnly cookie to minimize the risk of XSS attacks
        );
    }
}
