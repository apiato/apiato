<?php

namespace App\Port\Foundation\Portals;

use App\Port\Foundation\Exceptions\WrongConfigurationsException;
use Illuminate\Support\Facades\Config;

/**
 * Class PortButler.
 *
 * NOTE: You can access this Class functions with the facade [ModuleConfig].
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class PortButler
{

    /**
     * @return  mixed
     */
    public function getLoginWebPageName()
    {
        $loginPage = Config::get('hello.containers.login-url');

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
