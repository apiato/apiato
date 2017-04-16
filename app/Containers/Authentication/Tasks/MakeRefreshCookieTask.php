<?php

namespace App\Containers\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Config;

/**
 * Class MakeRefreshCookieTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class MakeRefreshCookieTask extends Task
{

    /**
     * @param $refreshToken
     *
     * @return  \Symfony\Component\HttpFoundation\Cookie
     */
    public function run($refreshToken)
    {
        // Save the refresh token in a HttpOnly cookie to minimize the risk of XSS attacks
        $refreshCookie = cookie(
            'refreshToken',
            $refreshToken,
            Config::get('apiato.api.refresh-expires-in'),
            null,
            null,
            false,
            true // HttpOnly
        );

        return $refreshCookie;
    }
}
