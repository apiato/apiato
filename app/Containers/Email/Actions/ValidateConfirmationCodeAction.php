<?php

namespace App\Containers\Email\Actions;

use App\Containers\Email\Exceptions\InvalidConfirmationCodeException;
use App\Port\Action\Abstracts\Action;
use Illuminate\Support\Facades\Cache;

/**
 * Class ValidateConfirmationCodeAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ValidateConfirmationCodeAction extends Action
{

    /**
     * @param $user
     * @param $code
     *
     * @return  bool
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
