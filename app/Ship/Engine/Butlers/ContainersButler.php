<?php

namespace App\Ship\Engine\Butlers;

use App\Ship\Features\Exceptions\WrongConfigurationsException;
use Illuminate\Support\Facades\Config;

/**
 * Class ContainersButler.
 *
 * Helper Class to serve on the Containers layer.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ContainersButler
{

    /**
     * @return  mixed
     */
    public function getLoginWebPageName()
    {
        $loginPage = Config::get('apiato.containers.login-page-url');

        if (is_null($loginPage)) {
            throw new WrongConfigurationsException();
        }

        return $loginPage;
    }



}
