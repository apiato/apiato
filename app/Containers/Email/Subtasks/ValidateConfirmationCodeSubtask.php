<?php

namespace App\Containers\Email\Subtasks;

use App\Containers\Email\Exceptions\InvalidConfirmationCodeException;
use App\Kernel\Subtask\Abstracts\Subtask;
use Illuminate\Support\Facades\Cache;

/**
 * Class ValidateConfirmationCodeSubtask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ValidateConfirmationCodeSubtask extends Subtask
{

    /**
     * @param $userId
     * @param $code
     *
     * @throws \App\Containers\Email\Subtasks\InvalidConfirmationCodeException
     */
    public function run($user, $code)
    {
        // find the confirmation code of this user from the cache
        $codeFromCache = Cache::get('user:email-confirmation-code:' . $user->id);

        // if code is valid
        if (!$codeFromCache && $codeFromCache != $code) {
            throw new InvalidConfirmationCodeException;
        }

        // update user state
        $user->confirmed = true;
        $user->save();

        // remove the confirmation code from the cache
        Cache::forget('user:email-confirmation-code:' . $user->id);

        return true;
    }
}
