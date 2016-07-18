<?php

namespace App\Containers\Email\Services;

use App\Containers\Email\Mails\ConfirmEmail;
use App\Containers\User\Models\User;
use App\Port\Service\Abstracts\Service;

/**
 * Class SendConfirmationEmailService.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SendConfirmationEmailService extends Service
{


    /**
     * SendConfirmationEmailService constructor.
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
        $result = $this->email->send($data = [
            'name' => $user->name,
            'url'  => $confirmationUrl,
        ]);

        return $result;
    }
}
