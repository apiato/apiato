<?php

namespace App\Containers\Email\Services;

use App\Containers\User\Models\User;
use App\Kernel\Service\Abstracts\Service;
use App\Services\Mails\Mails\ConfirmEmail;

/**
 * Class SendConfirmationEmailService.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SendConfirmationEmailService extends Service
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
