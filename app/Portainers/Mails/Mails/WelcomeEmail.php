<?php

namespace App\Portainers\Mails\Mails;

use App\Portainers\Mails\Abstracts\MailsAbstract;
use App\Portainers\Mails\Contracts\MailsInterface;

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
    public $template = 'welcome';

    /**
     * The email subject
     *
     * @var  string
     */
    public $subject = 'Welcome to Hello API';
}
