<?php

namespace App\Containers\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Config;

class MakeRefreshCookieTask extends Task
{
    public function run($refreshToken)
    {
        // Save the refresh token in a HttpOnly cookie to minimize the risk of XSS attacks
        return cookie(
            'refreshToken',
            $refreshToken,
            Config::get('apiato.api.refresh-expires-in'),
            null,
            null,
            Config::get('session.secure'),
            true // HttpOnly
        );
    }
}
