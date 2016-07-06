<?php

namespace App\Containers\Email\Actions;

use App\Containers\Email\Services\GenerateEmailConfirmationUrlService;
use App\Containers\Email\Services\SendConfirmationEmailService;
use App\Containers\Email\Services\SetUserEmailService;
use App\Ship\Action\Abstracts\Action;

/**
 * Class SetUserEmailAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SetUserEmailAction extends Action
{

    /**
     * @var  \App\Containers\Email\Services\SetUserEmailService
     */
    private $setUserEmailService;

    /**
     * @var  \App\Containers\Email\Services\GenerateEmailConfirmationUrlService
     */
    private $generateEmailConfirmationUrlService;

    /**
     * @var  \App\Containers\Email\Services\SendConfirmationEmailService
     */
    private $sendConfirmationEmailService;

    /**
     * SetUserEmailAction constructor.
     *
     * @param \App\Containers\Email\Services\SetUserEmailService                 $setUserEmailService
     * @param \App\Containers\Email\Services\GenerateEmailConfirmationUrlService $generateEmailConfirmationUrlService
     * @param \App\Containers\Email\Services\SendConfirmationEmailService        $sendConfirmationEmailService
     */
    public function __construct(
        SetUserEmailService $setUserEmailService,
        GenerateEmailConfirmationUrlService $generateEmailConfirmationUrlService,
        SendConfirmationEmailService $sendConfirmationEmailService
    ) {
        $this->setUserEmailService = $setUserEmailService;
        $this->generateEmailConfirmationUrlService = $generateEmailConfirmationUrlService;
        $this->sendConfirmationEmailService = $sendConfirmationEmailService;
    }


    /**
     * @param $userId
     * @param $email
     *
     * @return  bool
     */
    public function run($userId, $email)
    {
        // set the email on the user in the database
        $user = $this->setUserEmailService->run($userId, $email);

        // generate confirmation code, store it on the memory and inject it in url
        $confirmationUrl = $this->generateEmailConfirmationUrlService->run($user);

        // send a confirmation email to the user with the link
        $this->sendConfirmationEmailService->run($user, $confirmationUrl);

        return true;
    }
}
