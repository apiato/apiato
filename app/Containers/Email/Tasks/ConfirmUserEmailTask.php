<?php

namespace App\Containers\Email\Tasks;

use App\Containers\User\Models\User;
use App\Port\Action\Abstracts\Action;

/**
 * Class ConfirmUserEmailTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ConfirmUserEmailTask extends Action
{

    /**
     * @param \App\Containers\User\Models\User $user
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run(User $user)
    {
        // update user state
        $user->confirmed = true;
        $user->save();

        return $user;
    }
}
