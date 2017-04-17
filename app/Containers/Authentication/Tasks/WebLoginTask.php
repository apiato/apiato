<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Exceptions\AuthenticationFailedException;
use App\Ship\Parents\Tasks\Task;

/**
 * Class WebLoginTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebLoginTask extends Task
{
    /**
     * @param            $email
     * @param            $password
     * @param bool|false $remember
     *
     * @return  mixed
     */
    public function run($email, $password, $remember = false)
    {
        // TODO:..
        dump('incomplete..');
    }

}
