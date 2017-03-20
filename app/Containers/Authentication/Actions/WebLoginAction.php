<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\WebLoginTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class WebLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebLoginAction extends Action
{
    /**
     * @param $email
     * @param $password
     * @param $remember
     *
     * @return  mixed
     */
    public function run($email, $password, $remember)
    {
        $user = $this->call(WebLoginTask::class, [$email, $password, $remember]);

        return $user;
    }
}
