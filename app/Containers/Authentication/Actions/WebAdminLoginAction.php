<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\WebLoginTask;
use App\Containers\Authorization\Tasks\IsUserAdminTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class WebAdminLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebAdminLoginAction extends Action
{
    /**
     * @param $email
     * @param $password
     * @param $remember
     *
     * @return  array|mixed
     */
    public function run($email, $password, $remember)
    {
        $user = $this->call(WebLoginTask::class, [$email, $password, $remember]);

        if ($user) {
            $this->call(IsUserAdminTask::class, [$user]);
        }

        return $user;
    }
}
