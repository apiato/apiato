<?php

namespace App\Containers\Email\Tasks;

use App\Containers\Email\Exceptions\InvalidConfirmationCodeException;
use App\Kernel\Task\Abstracts\Task;
use Illuminate\Support\Facades\Cache;

/**
 * Class ValidateConfirmationCodeTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ValidateConfirmationCodeTask extends Task
{

    /**
     * @param $userId
     * @param $code
     *
     * @throws \App\Containers\Email\Tasks\InvalidConfirmationCodeException
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
