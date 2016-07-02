<?php

namespace App\Containers\Email\Subtasks;

use App\Containers\User\Models\User;
use App\Kernel\Subtask\Abstracts\Subtask;
use App\Services\Mails\Mails\ConfirmEmail;

/**
 * Class SendConfirmationEmailSubtask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SendConfirmationEmailSubtask extends Subtask
{

    /**
     * @param \App\Containers\User\Models\User $user
     * @param                                  $confirmationUrl
     */
    public function run(User $user, $confirmationUrl)
    {
        $email = new ConfirmEmail();
        $email->setEmail($user->email);
        $email->setName($user->name);
        $email->send($data = [
            'name' => $user->name,
            'url'  => $confirmationUrl,
        ]);

        return true;
    }
}
