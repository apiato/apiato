<?php

namespace App\Containers\Contact\Mails;

use App\Port\Email\Abstracts\MailsAbstract;
use App\Port\Email\Contracts\MailsInterface;

/**
 * Class WelcomeEmail.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ContactUsEmail extends MailsAbstract implements MailsInterface
{

    /**
     * The email template name. (a view file name form "app/Tasks/Mails/Views/")
     *
     * @var  string
     */
    public $template = 'contactUs';
}
