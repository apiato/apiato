<?php

namespace App\Containers\Email\Tasks;

use App\Containers\Email\Exceptions\UserEmailNotFoundException;
use App\Containers\User\Models\User;
use App\Port\Task\Abstracts\Task;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;

/**
 * Class GenerateEmailConfirmationUrlTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GenerateEmailConfirmationUrlTask extends Task
{

    /**
     * How long to keep the validation code on the memory (valid)
     *
     * default: 48 hours (2880 minutes)
     */
    const CONFIRMATION_CODE_VALIDATE_TIME = 2880;

    /**
     * @param $email
     * @param $password
     *
     * @return mixed
     */
    public function run(User $user)
    {
        // check if email exist on the user
        if (!$user->email) {
            throw new UserEmailNotFoundException;
        }

        // generate random unique token
        $confirmationCode = sha1(time() . $user->id);

        // 3. set token next to user id in the memory (redis)
        Cache::put('user:email-confirmation-code:' . $user->id, $confirmationCode,
            self::CONFIRMATION_CODE_VALIDATE_TIME);

        // set user status not confirmed (in case the user is updating his email)
        $user->confirmed = false;
        $user->save();

        // build the url email confirmation URL with the confirmation code and user id
        $confirmationUrl = URL::to('/') . '/users/' . $user->id . '/email/confirmation/' . $confirmationCode;

        return $confirmationUrl;
    }
}
