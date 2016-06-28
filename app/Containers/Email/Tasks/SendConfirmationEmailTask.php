<?php

namespace App\Containers\Email\Tasks;

use App\Containers\User\Models\User;
use App\Kernel\Task\Abstracts\Task;
use App\Services\Mails\Mails\ConfirmEmail;

/**
 * Class SendConfirmationEmailTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SendConfirmationEmailTask extends Task
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
