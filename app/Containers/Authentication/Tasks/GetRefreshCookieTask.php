<?php

namespace App\Containers\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Config;

/**
 * Class GetRefreshCookieTask.
 */
class GetRefreshCookieTask extends Task
{
    public function run($refreshToken)
    {
        return cookie(
            'refreshToken',
            $refreshToken,
            Config::get('apiato.api.refresh-expires-in'),
            null,
            null,
            false,
            true // HttpOnly
        );
    }
}
