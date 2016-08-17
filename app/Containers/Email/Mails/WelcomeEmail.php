<?php

namespace App\Containers\Email\Mails;

use App\Port\Email\Abstracts\MailsAbstract;
use App\Port\Email\Contracts\MailsInterface;

/**
 * Class WelcomeEmail.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WelcomeEmail extends MailsAbstract implements MailsInterface
{

    /**
     * The email template name. (a view file name form "app/Tasks/Mails/Views/")
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
