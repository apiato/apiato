<?php

namespace App\Containers\Email\Tasks;

use App\Containers\Email\Mails\ConfirmEmail;
use App\Containers\User\Models\User;
use App\Port\Task\Abstracts\Task;

/**
 * Class SendConfirmationEmailTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SendConfirmationEmailTask extends Task
{


    /**
     * SendConfirmationEmailTask constructor.
     *
     * @param \App\Containers\Email\Mails\ConfirmEmail $confirmEmail
     */
    public function __construct(ConfirmEmail $confirmEmail)
    {
        $this->confirmEmail = $confirmEmail;
    }

    /**
     * @param \App\Containers\User\Models\User $user
     * @param                                  $confirmationUrl
     *
     * @return  bool
     */
    public function run(User $user, $confirmationUrl)
    {
        $result = $this->confirmEmail->to($user->email, $user->name)->send([
            'name' => $user->name,
            'url'  => $confirmationUrl,
        ]);

        return $result;
    }
}
