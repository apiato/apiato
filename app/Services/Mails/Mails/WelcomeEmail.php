<?php

namespace App\Services\Mails\Mails;

use App\Services\Mails\Abstracts\MailsAbstract;
use App\Services\Mails\Contracts\MailsInterface;

/**
 * Class WelcomeEmail.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WelcomeEmail extends MailsAbstract implements MailsInterface
{

    /**
     * The email template name. (a view file name form "app/Services/Mails/Views/")
     *
     * @var  string
     */
    public $template = 'sampler';

    /**
     * The email subject
     *
     * @var  string
     */
    public $subject = 'Welcome to Skins.io';
}
