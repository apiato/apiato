<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Exceptions\LoginFailedException;
use App\Ship\Parents\Tasks\Task;
use Auth;

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
     * @return mixed
     * @throws LoginFailedException
     */
    public function run($email, $password, bool $remember = false)
    {
        if (!$user = Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            throw new LoginFailedException();
        }

        return Auth::user();
    }

}
