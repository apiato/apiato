<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;

class MakeRefreshCookieTask extends Task
{
    public function run($refreshToken)
    {
        // Save the refresh token in a HttpOnly cookie to minimize the risk of XSS attacks
        return cookie(
            'refreshToken',
            $refreshToken,
            config('apiato.api.refresh-expires-in'),
            null,
            null,
            config('session.secure'),
            true // HttpOnly
        );
    }
}
