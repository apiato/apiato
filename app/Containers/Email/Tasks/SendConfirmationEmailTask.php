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
        $this->email = $confirmEmail;
    }

    /**
     * @param \App\Containers\User\Models\User $user
     * @param                                  $confirmationUrl
     *
     * @return  bool
     */
    public function run(User $user, $confirmationUrl)
    {
        $this->email->setEmail($user->email);
        $this->email->setName($user->name);
        $result = $this->email->send([
            'name' => $user->name,
            'url'  => $confirmationUrl,
        ]);

        return $result;
    }
}
