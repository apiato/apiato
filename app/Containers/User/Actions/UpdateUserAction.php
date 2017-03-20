<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\User\Tasks\UpdateUserTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class UpdateUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserAction extends Action
{

    /**
     * @param null $password
     * @param null $name
     * @param null $email
     * @param null $gender
     * @param null $birth
     *
     * @return  mixed
     */
    public function run($password = null, $name = null, $email = null, $gender = null, $birth = null)
    {
        // user can only update himself
        $userId = $this->call(GetAuthenticatedUserTask::class)->id;

        $user = $this->call(UpdateUserTask::class, [$userId, $password, $name, $email, $gender, $birth]);

        return $user;
    }
}
