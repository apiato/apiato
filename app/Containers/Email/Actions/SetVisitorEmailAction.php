<?php

namespace App\Containers\Email\Actions;

use App\Containers\Email\Services\GenerateEmailConfirmationUrlService;
use App\Containers\Email\Services\SendConfirmationEmailService;
use App\Containers\Email\Services\SetUserEmailService;
use App\Containers\User\Services\FindUserService;
use App\Port\Action\Abstracts\Action;

/**
 * Class SetVisitorEmailAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SetVisitorEmailAction extends Action
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
     * @var  \App\Containers\User\Services\FindUserService
     */
    private $findUserService;

    /**
     * SetUserEmailAction constructor.
     *
     * @param \App\Containers\Email\Services\SetUserEmailService                 $setUserEmailService
     * @param \App\Containers\Email\Services\GenerateEmailConfirmationUrlService $generateEmailConfirmationUrlService
     * @param \App\Containers\Email\Services\SendConfirmationEmailService        $sendConfirmationEmailService
     * @param \App\Containers\User\Services\FindUserService                      $findUserService
     */
    public function __construct(
        SetUserEmailService $setUserEmailService,
        GenerateEmailConfirmationUrlService $generateEmailConfirmationUrlService,
        SendConfirmationEmailService $sendConfirmationEmailService,
        FindUserService $findUserService
    ) {
        $this->setUserEmailService = $setUserEmailService;
        $this->generateEmailConfirmationUrlService = $generateEmailConfirmationUrlService;
        $this->sendConfirmationEmailService = $sendConfirmationEmailService;
        $this->findUserService = $findUserService;
    }


    /**
     * @param $userId
     * @param $email
     *
     * @return  bool
     */
    public function run($visitorId, $email)
    {
        $user = $this->findUserService->byVisitorId($visitorId);

        $this->setUserEmailService->run($user->id, $email);

        return true;
    }
}
