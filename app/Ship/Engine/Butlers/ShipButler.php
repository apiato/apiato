<?php

namespace App\Ship\Engine\Butlers;

use App\Ship\Features\Exceptions\WrongConfigurationsException;
use Illuminate\Support\Facades\Config;

/**
 * Class ShipButler.
 *
 * General Helper Class to serve any class inside the Ship Layer.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ShipButler
{

    /**
     * @return  mixed
     */
    public function getLoginWebPageName()
    {
        $loginPage = Config::get('hello.containers.login-page-name');

        if (is_null($loginPage)) {
            throw new WrongConfigurationsException();
        }

        return $loginPage;
    }

    /**
     * check if a word starts with another word
     *
     * @param $word
     * @param $startsWith
     *
     * @return  bool
     */
    public function stringStartsWith($word, $startsWith)
    {
        return (substr($word, 0, strlen($startsWith)) === $startsWith);
    }

}
